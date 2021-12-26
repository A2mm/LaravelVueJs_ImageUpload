<template>
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <div class="col-md-8">
                <div class="card mt-25">
                    <div class="card-header">Laravel Vue JS Image Upload </div>
 
                    <div class="card-body">
                        <div v-if="success != ''" class="alert alert-success" role="alert">
                          {{success}}
                                <div>
                                 Image : <img width="500" height="200" :src="'/images/' + path"> 
                                </div> 
                        </div>
                        <form @submit="formSubmit" enctype="multipart/form-data">
                            
                        <strong>Image:</strong>

                        <input type="file" class="form-control" v-on:change="onImageChange">

                        <div id="preview">
                            <img width="200" height="100"  v-if="url" :src="url" />
                        </div>

                        <!-- for preview image purpose before upload -->
 
                        <button class="btn btn-success" style="margin-top: 15px;">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {

        mounted() {
            console.log('Component mounted.')
        },

        data() {
            return {
              image: '',
              success: '',
              path : '',
              article : '',
              url: '',
            };
        },
        methods: {

            // start onImageChange
            onImageChange(e){
                console.log(e.target.files[0]);
                this.image = e.target.files[0];

                const fille = e.target.files[0]
                this.url    = URL.createObjectURL(fille);
                console.log(url);
            },
            // end onImageChange

            // start formSubmit
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
 
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
 
                let formData = new FormData();
                formData.append('image', this.image);
 
                axios.post('/api/formSubmit', formData, config)
                .then(function (response) {
                    currentObj.success = response.data.success;
                    currentObj.path    = response.data.path;
                    currentObj.article = response.data.article;
                    currentObj.url     = '';
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            } // end formSubmit
        
        } // end methods
    }
</script>