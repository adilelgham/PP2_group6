<template>
<div>
    <navbar></navbar> 
    <div class="container">
        <h1 style="font-size: 40px;">Forgot password</h1>

        <p v-if="bool == true" style="color : green; font-size:15px; text-align: center;"> email sent</p>

        <p v-if="bool == false" style="color : red; font-size:15px; text-align: center;"> email does not exist</p>



        <input type="email" class="form-control" placeholder="Email" v-model="email">

       

        <button @click.prevent="check" type="submit" class="btn btn-danger" style="margin-left:80px;">send Email</button>

    </div>
    <div id="dbutton">
      <b-button
        @click="backbutton"
        class="button button-close"
        squared
        variant="outline-danger"
        >Back</b-button
      >
    </div>
    
</div>
</template>

<script>
export default {
    data(){
        return{
            email:'',
            forgot:'',
            firstName:'',
            bool:null,
        }
    },
    methods:{
        //functie that send an email
        sendEmail(){
            axios.post('/api/forgot',  {

                    email: this.email,
                    forgot: this.forgot,
                    firstName: this.firstName,

                }).then(()=>{
    

            }).catch(()=>{
                console.log("functie email error");
            })
        },


        //functie that check if email exist

        check(){
            axios.get('/api/allUsers').then((res)=>{

                for(let a in res.data){

                

                    if(res.data[a].email == this.email){
                    

                        this.forgot = res.data[a].forgot_password;
                        this.firstName = res.data[a].firstName;

                        

                        
                        this.sendEmail(this.forgot);
                
                        this.bool= true;

                        this.$router.push({name:"login"});
                    }  


                
                    
                
                }

                if(this.bool != true){
                    this.bool = false;
                }


            }).catch(()=>{
                //console.log("check error");
            })
        },
           backbutton() {
            this.$router.push({ name: "dashboard" });
            },
        
    }
    
}
</script>
<style scoped>
#dbutton {
  margin-left: 540px;
}
.container{
    position: relative;
    width: 280px; 
    height:400px; 
    margin-top: 100px;
}
h1{
    text-align: center; 
    font-size:50px; 
    font-family:Georgia
}

input{
    margin-top: 18px;
}

button{
    margin-top:18px;
    margin-left:90px;
}
#button-back {
    margin-left: 609px;
    margin-top: 35px;
}



</style>