<template>
    <v-form
        ref="form"
        lazy-validation
    >
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
                :type="show.password ? 'text' : 'password'"
                :append-icon="show.password ? 'mdi-eye' : 'mdi-eye-off'"
                @click:append="show.password = !show.password"
                v-model="user.password"
                :rules="[rules.password.counter, rules.password.require]"
            ></v-text-field>
        </v-col>
        <v-divider></v-divider>
        <v-card-actions>
            <v-btn @click="cancel">Cancel</v-btn>
            <v-spacer></v-spacer>
            <v-btn @click="login">Login</v-btn>
        </v-card-actions>
    </v-form>
</template>

<script>
export default {
    name: "LogInComponent",
    props: {
        toAfterLoggedIn:{
            type: String,
            default: '/home'
        }
    },
    data(){
        return {
            user:{},
            alert:{
                message:""
            },
            show:{
                password:false
            },
            rules:{
                email:{
                    email:value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Invalid e-mail.'
                    },
                    require:value => !!value || 'Required.'
                },
                password:{
                    counter: value => (value !== undefined && value.length) >= 8 || 'Mix 8',
                    require:value => !!value || 'Required.'
                }
            },
            valid:false
        }
    },
    methods: {
        login(){
            if(this.$refs.form.validate()){
                axios.post('/api/login', this.user)
                    .then((res) => {
                        this.$router.go({path: this.toAfterLoggedIn, force: true})
                        // this.$router.push(this.toAfterLoggedIn)
                    })
                    .catch((err) => {
                        this.showAlert(err.response.data.message);
                    })
            }
        },
        cancel(){
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
