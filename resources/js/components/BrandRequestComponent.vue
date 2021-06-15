<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Brand Request Component</div>

                    <div class="card-body">
                        <div class="alert alert-danger" v-if="errors.length">
                            <b>Please correct the following error(s):</b>
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                        <form action="#" @submit="validateForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
                                       v-model="brandForm.name"
                                />
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                                    v-model="brandForm.email"
                                />
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Brand Name:</label>
                                <input type="text" class="form-control" id="brand_name" placeholder="Enter brand name" name="brand_name"
                                    v-model="brandForm.brandName"
                                />
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="upload_cr" v-model="brandForm.uploadCr"> Upload CR</label>
                            </div>
                            <div class="form-group" v-if="brandForm.uploadCr">
                                <label for="brand_cr_file">Brand CR File:</label>
                                <input type="file" class="form-control" ref="file" id="brand_cr_file" placeholder="Enter brand cr" name="brand_cr_file"
                                       v-on:change="handleFileUpload()"
                                />
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return {
              errors: [],
              brandForm: {
                  name: '',
                  email: '',
                  brandName: '',
                  uploadCr: false,
                  brandCrFile: ''
              },
          }
        },
        methods: {
            validateForm(e) {
                this.errors = [];

                if (!this.brandForm.name) this.errors.push("Name is required.");
                if (!this.brandForm.email) this.errors.push("Email is required.");
                if (!this.brandForm.brandName) this.errors.push("Brand name is required.");
                if (this.brandForm.uploadCr && !(this.brandForm.brandCrFile)) {
                    this.errors.push("Brand cr file is required.");
                }
                if (this.brandForm.uploadCr && (this.brandForm.brandCrFile) && (this.brandForm.brandCrFile.type != 'application/pdf')) {
                    this.errors.push("The brand cr file must be a file of type: pdf.");
                }

                if(this.errors.length == 0){
                    this.submitForm();
                }

                e.preventDefault();
            },
            handleFileUpload(){
                this.brandForm.brandCrFile = this.$refs.file.files[0];
            },
            generateFormData(){
                let formData = new FormData();
                for (const property in this.brandForm) {
                    formData.append(property, this.brandForm[property]);
                }
                return formData;
            },
            alert(type, message){
                Swal.fire({
                    position: 'top-end',
                    icon: type,
                    title: message,
                    showConfirmButton: false,
                    timer: 2000
                });
            },
            resetForm(){
                this.brandForm = {
                    name: '',
                    email: '',
                    brandName: '',
                    uploadCr: false,
                    brandCrFile: ''
                }
            },
            submitForm(){
                axios.post('/user/store', this.generateFormData(), {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                })
                .then( response => {
                    if(response.data.statusCode==200){
                        this.resetForm();
                        this.alert('success', response.data.message);
                    } else {
                        this.alert('error', response.data.message);
                    }
                })
                .catch( error => {
                    console.log("Error Response: ", error.response);
                    console.log("Response Data: ", error.response.data.errors);

                    for (var key in error.response.data.errors){
                        this.errors.push(error.response.data.errors[key].toString());
                    }
                    // this.errors.push(error.response.data.errors);
                });
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
