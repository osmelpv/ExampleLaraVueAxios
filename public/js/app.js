
new Vue({
	el: '#myRecords',
	created: function(){
		this.getRecords();
	},
	data: {
		records: [],
		pagination: {
			'total': 0,
            'current_page': 0,
            'perPage': 0,
            'lastPage': 0,
            'from': 0,
            'to': 0
		},
		//creating New Record		
		errors: [],
		offset: 3, // pagination offset
		options: ['inactive', 'active'],
		//Update/create Record
		fillRecord: {
			'id': '', 
			'uuid': '', 
			'name': '', 
			'description': '', 
			'code': '', 
			'status': ''
		}
	},
	computed:{
		isActived: function(){
			return this.pagination.current_page;
		},
		pagesNumber: function(){
			if(!this.pagination.to){
				return [];
			}

			var from = this.pagination.current_page - this.offset;

			if (from < 1) {
				from = 1;
			}

			var to = from + (this.offset * 2); 
			if (to>= this.pagination.lastPage) {
				to = this.pagination.lastPage;
			}

			var pagesArray = [];
			while(from <= to){
				pagesArray.push(from);
				from++;
			}
			return pagesArray;
		}
	},
	methods: {
		emptyFills: function (){ // clean fields in modal first
			this.fillRecord = {
				'id': '', 
				'uuid': '', 
				'name': '', 
				'description': '', 
				'code': '', 
				'status': ''
			};
		},
		getRecords: function (page) {
			var urlRecords = 'records?page=' +page;
			axios.get(urlRecords).then(response =>{
				this.records = response.data.records.data,
				this.pagination = response.data.pagination
			});
		},
		editRecord: function (record) { //load the edit fields
			this.fillRecord.id = record.id;
			this.fillRecord.uuid = record.uuid;
			this.fillRecord.name = record.name;
			this.fillRecord.description = record.description;
			this.fillRecord.code = record.code;
			this.fillRecord.status = record.status;
			$('#edit').modal('show');
		},
		updateRecord: function (id) { // update in the data base
			var urlUpdate = 'records/' + id;
			axios.put(urlUpdate, this.fillRecord).then(response => {
				this.getRecords(this.pagination.current_page);
				this.emptyFills();
				$('#edit').modal('hide');
				toastr.success('Record updated');
			}).catch(error => {
				this.errors = error.response.data
			});
		},
		deleteRecord: function (record) {
			var urlDelete = 'records/' + record.id;
			axios.delete(urlDelete).then(response => {
				this.getRecords(this.pagination.current_page);
				toastr.success('Record deleted');
			});
		},
		preCreate: function () { //before load the modal clean
			this.emptyFills();
			$('#create').modal('show');
		},
		createRecord: function () { // create the record in data base
			var urlCreate = 'records';
			axios.post(urlCreate, {
				uuid: this.fillRecord.uuid,
				name: this.fillRecord.name,
				description: this.fillRecord.description,
				code: this.fillRecord.code,
				status: this.fillRecord.status
			}).then(response => {
				this.getRecords(this.pagination.current_page);				
				this.errors = [];
				$('#create').modal('hide');
				toastr.success('New record created');
			}).catch(error => {
				this.errors = error.response.data
			});
		},
		changePage: function (page) {
			this.pagination.current_page = page;
			this.getRecords(page);
		}
	}

});