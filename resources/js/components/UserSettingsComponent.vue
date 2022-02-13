<template>
    <div>
        <header-component>

        </header-component>

        <v-main>

            <v-sheet
                outlined
                color="grey"
                rounded
                class="my-2"
            >
                <v-card
                    class="mx-auto"
                    outlined
                >

                    <v-list>
                        <v-container>
                            <v-list-item two-line>
                                <v-list-item-content>
                                    <v-list-item-title>ユーザーネームの変更</v-list-item-title>
                                    <v-list-item-subtitle></v-list-item-subtitle>
                                </v-list-item-content>
                                <v-form
                                    ref="changeUserNameForm"
                                    lazy-validation
                                >
                                    <v-row
                                        align="center"
                                        justify="end"
                                    >
                                        <v-btn
                                            outlined
                                            text
                                            @click="dialog.changeName = true"
                                        >
                                            Change user name
                                        </v-btn>
                                        <v-dialog
                                            v-model="dialog.changeName"
                                            width="500"
                                        >
                                            <v-card>
                                                <v-card-title
                                                    class="text-h5 grey lighten-2"
                                                >
                                                    Enter a new username
                                                </v-card-title>

                                                <v-divider></v-divider>
                                                <v-text-field
                                                    v-model="input.name"
                                                    hint="20文字以内で入力してください。"
                                                    :counter="20"
                                                    label="New Name"
                                                    required
                                                    class="mx-5"
                                                    :rules="[rules.name.counter, rules.name.require]"
                                                ></v-text-field>

                                                <v-card-actions>
                                                    <v-btn
                                                        @click="dialog.changeName = false"
                                                    >
                                                        Cancel
                                                    </v-btn>
                                                    <v-spacer></v-spacer>

                                                    <v-btn
                                                        color="primary"
                                                        @click="changeName"
                                                    >
                                                        Change username
                                                    </v-btn>
                                                </v-card-actions>
                                            </v-card>
                                        </v-dialog>
                                    </v-row>
                                </v-form>
                            </v-list-item>
                        </v-container>
                    </v-list>

                    <v-divider></v-divider>

                    <v-list>
                        <v-container>
                            <v-list-item two-line>
                                <v-list-item-content>
                                    <v-list-item-title>メールアドレスの変更</v-list-item-title>
                                    <v-list-item-subtitle></v-list-item-subtitle>
                                </v-list-item-content>
                                <v-form
                                    ref="changeEmailForm"
                                    lazy-validation
                                >
                                    <v-row
                                        align="center"
                                        justify="end"
                                    >
                                        <v-btn
                                            outlined
                                            text
                                            @click="dialog.changeEmail = true"
                                        >
                                            Change Email
                                        </v-btn>
                                        <v-dialog
                                            @click:outside="pushEmailChangeDialogOutside"
                                            v-model="dialog.changeEmail"
                                            width="500"
                                        >
                                            <v-card>
                                                <v-card-title class="text-h5 grey lighten-2">
                                                    Change Email
                                                </v-card-title>

                                                <v-text-field
                                                    v-model="input.email"
                                                    required
                                                    class="mx-5"
                                                    clearable
                                                    :rules="[rules.email.email, rules.email.require]"
                                                ></v-text-field>

                                                <v-divider></v-divider>
                                                <v-card-actions>
                                                    <v-btn
                                                        text
                                                        @click="pushEmailChangeDialogOutside"
                                                    >
                                                        Cancel
                                                    </v-btn>
                                                    <v-spacer></v-spacer>

                                                    <v-btn
                                                        color="primary"
                                                        text
                                                        @click="changeEmail"
                                                    >
                                                        Change Email
                                                    </v-btn>
                                                </v-card-actions>
                                            </v-card>
                                        </v-dialog>
                                    </v-row>
                                </v-form>
                            </v-list-item>
                        </v-container>
                    </v-list>

                    <v-divider></v-divider>

                    <v-list>
                        <v-container>
                            <v-list-item two-line>
                                <v-list-item-content>
                                    <v-list-item-title>パスワードの変更</v-list-item-title>
                                    <v-list-item-subtitle></v-list-item-subtitle>
                                </v-list-item-content>
                                <v-form
                                    ref="changePasswordForm"
                                    lazy-validation
                                >
                                    <v-row
                                        align="center"
                                        justify="end"
                                    >
                                        <v-btn
                                            outlined
                                            text
                                            @click="dialog.changePassword = true"
                                        >
                                            Change Password
                                        </v-btn>
                                        <v-dialog
                                            v-model="dialog.changePassword"
                                            width="500"
                                            @click:outside="pushPasswordChangeDialogOutside"
                                        >
                                            <v-card>
                                                <v-card-title class="text-h5 grey lighten-2">
                                                    Change password
                                                </v-card-title>
                                                <v-text-field
                                                    v-model="input.currentPassword"
                                                    required
                                                    class="mx-5"
                                                    :type="show.currentPassword ? 'text' : 'password'"
                                                    :append-icon="show.currentPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                                    @click:append="show.currentPassword = !show.currentPassword"
                                                    :rules="[rules.password.counter, rules.password.require]"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="input.newPassword"
                                                    required
                                                    class="mx-5"
                                                    :type="show.newPassword ? 'text' : 'password'"
                                                    :append-icon="show.newPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                                    @click:append="show.newPassword = !show.newPassword"
                                                    :rules="[rules.password.counter, rules.password.require]"
                                                ></v-text-field>
                                                <v-card-text>

                                                </v-card-text>

                                                <v-divider></v-divider>
                                                <v-card-actions>
                                                    <v-btn
                                                        text
                                                        @click="pushPasswordChangeDialogOutside"
                                                    >
                                                        Cancel
                                                    </v-btn>
                                                    <v-spacer></v-spacer>

                                                    <v-btn
                                                        color="primary"
                                                        text
                                                        @click="changePassword"
                                                    >
                                                        Change password
                                                    </v-btn>
                                                </v-card-actions>
                                            </v-card>
                                        </v-dialog>
                                    </v-row>
                                </v-form>
                            </v-list-item>
                        </v-container>
                    </v-list>

                </v-card>
            </v-sheet>

            <v-spacer></v-spacer>

            <v-sheet outlined color="red" rounded>
                <v-card
                    class="mx-auto"
                    outlined
                >
                    <v-list>
                        <v-container>
                            <v-list-item two-line>
                                <v-list-item-content>
                                    <v-list-item-title>すべての目標とタスクを削除する</v-list-item-title>
                                    <v-list-item-subtitle>公開中の目標も削除されます。</v-list-item-subtitle>
                                </v-list-item-content>
                                <v-row
                                    align="center"
                                    justify="end"
                                >
                                    <v-btn
                                        outlined
                                        text
                                        @click="dialog.deleteAllGoals = true"
                                    >
                                        Delete All Goals
                                    </v-btn>
                                    <v-dialog v-model="dialog.deleteAllGoals" width="500">
                                        <v-card>
                                            <v-card-title class="text-h5 grey lighten-2">
                                                Delete All Goals
                                            </v-card-title>

                                            <v-card-text>
                                                一度削除すると元に戻せません。削除しますか？
                                            </v-card-text>

                                            <v-divider></v-divider>
                                            <v-card-actions>
                                                <v-btn
                                                    text
                                                    @click="dialog.deleteAllGoals = true"
                                                >
                                                    Cancel
                                                </v-btn>
                                                <v-spacer></v-spacer>

                                                <v-btn
                                                    color="primary"
                                                    text
                                                    @click="deleteAllGoals"
                                                >
                                                    Delete All Goals
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </v-row>
                            </v-list-item>
                        </v-container>
                    </v-list>
                    <v-divider></v-divider>
                    <v-list>
                        <v-container>
                            <v-list-item two-line>
                                <v-list-item-content>
                                    <v-list-item-title>退会する</v-list-item-title>
                                    <v-list-item-subtitle>ユーザーデータ、目標、タスクがすべて削除されます。</v-list-item-subtitle>
                                </v-list-item-content>
                                <v-row
                                    align="center"
                                    justify="end"
                                >
                                    <v-btn
                                        outlined
                                        text
                                        @click="dialog.deleteAccount = true"
                                    >
                                        Delete account
                                    </v-btn>
                                    <v-dialog v-model="dialog.deleteAccount" width="500">
                                        <v-card>
                                            <v-card-title class="text-h5 grey lighten-2">
                                                退会
                                            </v-card-title>

                                            <v-card-text>
                                                一度削除すると復元できません。削除しますか？
                                            </v-card-text>

                                            <v-divider></v-divider>
                                            <v-card-actions>
                                                <v-btn
                                                    text
                                                    @click="dialog.deleteAccount = true"
                                                >
                                                    Cancel
                                                </v-btn>
                                                <v-spacer></v-spacer>

                                                <v-btn
                                                    color="primary"
                                                    text
                                                    @click="deleteAccount"
                                                >
                                                    Delete Account
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </v-row>
                            </v-list-item>
                        </v-container>
                    </v-list>
                    <v-divider></v-divider>
                </v-card>
            </v-sheet>
        </v-main>
    </div>
</template>
<script>
import HeaderComponent from "./Header/HeaderComponent";

export default {
    name: "UserSettingComponent",
    components: {HeaderComponent},
    data(){
        return {
            dialog:{
                deleteAllGoals:false,
                deleteAccount:false,
                changeName:false,
                changeEmail:false,
                changePassword:false
            },
            input:{
                name:"",
                email:"",
                currentPassword:"",
                newPassword:"",

            },
            current:{
                email:""
            },
            show:{
                currentPassword:false,
                newPassword:false
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
    created:function(){
        this.getUserEmail();
    },

    methods: {
        deleteAllGoals: function(){
            axios.delete('/api/objectives/delete')
                .then((res) => {
                })
                .catch((err) => {
                })        },
        deleteAccount: function(){
            axios.delete('/api/user/delete')
                .then((res) => {
                    this.$router.push('/')
                })
                .catch((err) => {
                })
        },
        changeName: function(){
            const sendData = {
                name : this.input.newName
            }
            if(this.$refs.changeUserNameForm.validate()) {
                axios.put('/api/user/update_name', sendData)
                    .then((res) => {
                        this.input.newName = '';
                        //再度画面の更新
                        this.$router.go({path: this.$router.currentRoute.path, force: true})
                    })
                    .catch((err) => {
                    })
            }

        },
        changeEmail: function(){
            const sendData = {
                email : this.input.email
            }
            if(this.$refs.changeEmailForm.validate()) {
                axios.put('/api/user/update_email', sendData)
                    .then((res) => {
                        this.input.email = '';
                        //再度画面の更新
                        this.$router.go({path: this.$router.currentRoute.path, force: true})
                    })
                    .catch((err) => {
                    })
            }
        },
        changePassword: function(){
            const sendData = {
                current_password: this.input.currentPassword,
                new_password: this.input.newPassword
            }
            if(this.$refs.changePasswordForm.validate()) {
                axios.put('/api/user/update_pass', sendData)
                    .then((res) => {
                        this.dialog.changePassword = false;
                        this.input.currentPassword = '';
                        this.input.newPassword = '';
                    })
                    .catch((err) => {
                    })
            }
        },
        getUserEmail: function(){
            axios.get('/api/user')
                .then((res) => {
                   this.current.email = res.data.email;
                })
                .catch((err) => {
                })
        },
        pushEmailChangeDialogOutside(){
            this.dialog.changeEmail=false;
            this.input.email = this.current.email;
        },
        pushPasswordChangeDialogOutside(){
            this.dialog.changePassword=false;
            this.input.currentPassword = '';
            this.input.newPassword = '';
        }


    }
}
</script>

<style scoped>

</style>
