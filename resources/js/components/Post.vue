<template>
    <div>
    <h2> POST </h2>

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" @click="newPost()" data-target="#exampleModal">
  New Post
</button>


<div v-for="post in posts" :key="post.id">
  <h4>{{ post.title }}</h4>
  <p> {{ post.body }} </p>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" @click="editPost(post)">
  Edit Post
</button>

<button class="btn btn-danger" @click="deleteProduct(post)">Delete</button>


</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 v-if="edit" class="modal-title" id="exampleModalLabel">
        Edit Post {{ post.title }} </h5>
        <h5 v-else="edit" class="modal-title" id="exampleModalLabel">
        Create Post </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
    <label for="exampleInputEmail1">post title </label>
    <input type="text" :class="['form-control',errors.title ? 'is-invalid' : '' ]"  placeholder="title" v-model="post.title">
    <span  class="bg-danger text-white p-1 reunded" v-if="errors.title">{{ errors.title[0] }}</span>
  </div>
 <div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea :class="['form-control',errors.body ? 'is-invalid' : '' ]" id="exampleFormControlTextarea1" v-model="post.body" rows="3"></textarea>
        <small  class="bg-danger text-white p-1 reunded" v-if="errors.body">{{ errors.body[0] }}</small>
  </div> 

  <input type="hidden" v-if="edit" name="_method" value="put" />

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
         <button type="button" class="btn btn-primary" v-if="edit" @click="updatePost">Save changes</button>

         <button type="button" class="btn btn-primary" v-else="edit" @click="createPost">Create</button>
      </div>
    </div>
  </div>
</div>

<ul class="pagination">
  <li v-for="link in links" :key="link.label" :class="['page-item', link.active? 'active' : '' ]" @click="getPostsPage(link.label)">  
  <router-link to="?page="  class="page-link" >
  
   {{link.label}}
  
  </router-link>
  
  </li>

</ul>
<div>

</div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            post:{
            id:'',
            title:'',
            body:''
            },
            errors:[],
            posts:[],
            edit:false,
            page:1,
            links:[]
        }
    },

    methods:{
        checkForm(){
        this.errors = [];
      if (this.post.title && this.post.body) {
        return true;
      }
      if (!this.post.title) {
        this.errors = {title:['title required.'] }
        return false
      }
      if (!this.post.body) {
        this.errors = {body:['body required.'] }
        return false
       }

      
    },
    editPost(post){
      this.edit = true
      this.post = post
    },
        createPost(){
       if (!this.checkForm())
          return ;
            axios.post('api/post' , this.post).then( response=>{
                if(response.data.status == false){
                    this.errors = response.data.errors
                    Toast.fire({
                      icon: 'error',
                      title: 'Unsuccessfully'
                    }) 
                }else{
                  Toast.fire({
                    icon: 'success',
                    title: 'Add post '+ this.post.title +' successfully'
                  })

                  this.posts.unshift(response.data.data)
                  this.post = {   id:'',title:'',body:''}
                  this.errors = []
                }
            })
        },
        updatePost(){
            axios.put('api/post/'+ this.post.id , this.post).then( response=>{

                if(response.data.status == false){
                    this.errors = response.data.errors
                    Toast.fire({
                      icon: 'error',
                      title: 'Unsuccessfully'
                    }) 
                }else{
                  Toast.fire({
                    icon: 'success',
                    title: 'Updated post  '+ this.post.title +' successfully'
                  })

                  this.post = {
                      id:'',
                      title:'',
                      body:''
                  }
                  this.errors = []
                }
            })
        },
        getPosts(){
          axios.get('/api/post?page='+this.page , this.post).then( response=>{

             this.posts = response.data.data
             this.links = response.data.meta.links
          })
        },
        getPostsPage(page){
           
          if( page == 'Next &raquo;'){
             page = this.page + 1;
          }
               
          if(page == '&laquo; Previous' && this.page > 1)
             this.page -=1;
        
          else{
           page = parseInt(page)
            if (page < 0 || page == this.page)
              {return;}
            this.page = page;

            }
          axios.get('/api/post?page='+this.page , this.post).then( response=>{

             this.posts = response.data.data
             console.log(response.data.meta.links)
             this.links = response.data.meta.links
          })
        },
        newPost(){
          this.edit = false;
          this.post = {id:'',title:'', body:''}
        },
        deleteProduct(post) {
              


axios.delete('api/post/'+ post.id , this.post).then( response=>{

                if(response.data.status == true){
                    Toast.fire({
                    icon: 'success',
                    title: 'Deleted Post  '+ this.post.title +' successfully'
                  })

                  
                  this.errors = []
                  let i  = this.posts.map(item => item.id).indexOf(post.id) 
this.posts.splice(i, 1)

this.post = {id:'',title:'',body:''}

                }else{
                    this.errors = response.data.errors
                    Toast.fire({
                      icon: 'error',
                      title: 'Unsuccessfully'
                    }) 
                  
                }
            })





            }
    },
    created(){
      //router.push({ path: "/post", query: { page: this.page } })
      this.getPosts()
    }
}
</script>