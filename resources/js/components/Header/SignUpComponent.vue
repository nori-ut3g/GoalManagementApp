<template>
    <v-form
        ref="form"
        lazy-validation
    >
        <v-col cols="12">
            <v-text-field
                label="UserName"
                hint="20文字以内で入力してください。"
                v-model="user.name"
                counter="20"
                :rules="[rules.name.counter, rules.name.require]"
            ></v-text-field>
        </v-col>
        <v-col cols="12">
            <v-text-field
                label="Email Address"
                v-model="user.email"
                :rules="[rules.email.email, rules.email.require]"
            ></v-text-field>

        </v-col>
        <v-col cols="12">
            <v-text-field
                label="Password"
                hint="8文字以上で入力してください"
                v-model="user.password"
                :type="show.password ? 'text' : 'password'"
                :append-icon="show.password ? 'mdi-eye' : 'mdi-eye-off'"
                @click:append="show.password = !show.password"
                :rules="[rules.password.counter, rules.password.require]"
            ></v-text-field>
        </v-col>
        <v-divider></v-divider>
        <v-card-actions>
            <v-btn @click="cancel">Cancel</v-btn>
            <v-spacer></v-spacer>
            <v-btn @click="submit">Sign Up</v-btn>
        </v-card-actions>

    </v-form>
</template>

<script>
export default {
    name: "SignUpComponent",
    props: {
        toAfterLoggedIn:{
            type: String,
            default: '/home'
        }
    },
    data: () => {
        return {
            user:{
                name:"",
                email:"",
                password:""
            },
            show:{
                password:false
            },
            rules:{
                name:{
                    counter:value => (value !== undefined && value.length) <= 20 || 'Max 20',
                    require:value => !!value || 'Required.'
                },
                email:{
                    email:value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Invalid e-mail.'
                    },
                    require:value => !!value || 'Required.'
                },
                password:{
                    counter:value => (value !== undefined && value.length) >= 8 || 'Mix 8',
                    require:value => !!value || 'Required.'
                }
            }
        }
    },

    methods: {
        submit(){
            if(this.$refs.form.validate()) {
                axios.post('/api/register', this.user)
                    .then((res) => {
                        this.login()
                    })
                    .catch((err) => {
                        this.showAlert(err.response.data.message);
                    })
            }
        },
        login(){
            axios.post('/api/login', this.user)
                .then((res) => {
                    this.$router.push(this.toAfterLoggedIn)
                })
                .catch((err) =>{
                    this.showAlert(err.response.data.message);
                })
        },
        cancel(){
            this.user.name="";
            this.user.email="";
            this.user.password="";
            this.$emit('parent-cancel')
        },
        showAlert(messages){
            let message = '';
            if(typeof messages === 'string'){
                message = messages;
            }else{
                Object.keys(messages).forEach(type => {
                    message += type + ':' + messages[type] + '\n';
                });
            }
            this.$emit('alert', message)
        }
    }
}
</script>

<style scoped>

</style>
