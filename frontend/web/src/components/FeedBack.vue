<template>
    <div class="feedback--container">
        <h1>Обратная связь</h1>
        <hr>
        <div class="message" v-show="message !== ''">
            {{message}}
        </div>
        <form @submit="validateForm" id="feedBackForm" v-show="message === ''">
            <div class="inputs-row">
                <div class="email-input">
                    <input
                            id="email"
                            v-model="email"
                            type="text"
                            name="email"
                            placeholder="Адрес эл. почты*"
                            required
                    >
                    <span class="error_text" data-name="email"></span>
                </div>
                <div class="user_name-input">
                    <input
                            id="user_name"
                            v-model="user_name"
                            type="text"
                            name="user_name"
                            placeholder="Как к вам обращаться*"
                            required
                    >
                    <span class="error_text" data-name="user_name"></span>
                </div>
            </div>
            <div class="inputs-row">
                <div class="agree-input">
                    <input
                            id="i_agree"
                            v-model="i_agree"
                            type="checkbox"
                            name="i_agree"
                            value="false"
                            required
                    >
                    <label for="i_agree">Согласен(a) на обработку персональных данных*</label>
                    <span class="error_text" data-name="i_agree"></span>
                </div>
            </div>
            <div class="inputs-row">
                <textarea
                        id="content"
                        v-model="content"
                        name="content"
                        placeholder="Введите сообщение, не более 1500 символов"
                        maxlength="1500"
                >
                </textarea>
                <span class="error_text" data-name="content"></span>
            </div>
            <div class="inputs-row">
                <a id="submitFeedback" href="#" type="submit" class="submit-button">Отправить</a>
            </div>
        </form>
    </div>
</template>

<script>
    import $ from 'jquery';
    import axios from 'axios';
    import validate from '../assets/js/validate.js';

    export default {
        data: function () {
            return {
                errors: [],
                user_name: null,
                email: null,
                i_agree: null,
                content: null,
                message: '',
                feedbackUrl: '/issue/add'
            }
        },
        mounted: function (e) {
            const self = this;
            $('#submitFeedback').on('click', function (e) {
                e.preventDefault();
                if (!$(this).hasClass('.loading')) {
                    self.validateForm(e);
                }
                return false;
            });
        },
        methods: {
            validateForm: function (e) {
                this.hideErrors();
                validate.validators.presence.message = '^Поле не может быть пустым';
                const constraints = {
                    'email': {
                        presence: true,
                        email: true,
                        email: {
                            message: "^Введен невалидный Email"
                        }
                    },
                    'user_name': {
                        presence: true,
                        length: {
                            minimum: 2,
                            maximum: 30,
                            tooShort: "^Минимальная длина - 2 символа",
                            tooLong: "^Максимальная длина 30 символов"
                        }
                    },
                    'i_agree': {
                        presence: {
                            message: '^Необходимо подтвердить согласие на обработку персональных данных'
                        },
                    },
                    'content': {
                        length: {
                            maximum: 1500,
                            tooLong: "^Максимальная длина 1500 символов"
                        }
                    }
                };
                const errors = validate($('#feedBackForm')[0], constraints);
                this.hideErrors();
                this.message = '';
                if (errors) {
                    this.showErrors(errors);
                    return false;
                } else {
                    this.sendFeedback(e);
                    return true;
                }
            },

            showErrors: function (errors) {
                for (let item in errors) {
                    $('#feedBackForm').find('.error_text[data-name="' + item + '"]').text(errors[item]).show();
                }
            },

            hideErrors: function (e) {
                $('#feedBackForm').find('.error_text').each(function () {
                    $(this).text('').hide();
                });
            },

            sendFeedback: function (e) {
                var self = this;
                grecaptcha.ready(function () {
                    grecaptcha.execute('6Lf5U4AUAAAAAHlLj7EDspczLwKzf8MlYLf6Misd', {action: 'feedback'})
                        .then(function (token) {
                            axios.post('/api/g-recapcha', {token: token}).then(response => {
                                self.addIssue(e);
                            })
                                .catch(er => {
                                    this.errors.push(er);
                                })
                        });
                });
            },

            addIssue: function (e) {
                var self = this;
                var form = $('#feedBackForm').serializeArray();
                var formData = {};
                for (var key in form) {
                    if (form.hasOwnProperty(key)) {
                        formData[form[key].name] = form[key].value;
                    }
                }
                if (formData) {
                    axios.post(self.feedbackUrl, formData).then(response => {
                        if (response.status === 200) {
                            $('#feedBackForm')[0].reset();
                            self.message = 'Спасибо за обращение, ваше сообщение отправлено';
                        }
                    })
                        .catch(e => {
                            this.errors.push(e);
                        })
                }
                e.preventDefault();
            }
        }
    }
</script>
<style lang="scss">
    .feedback--container {
        font-size: 20px;
        padding: 40px 0px;
        h1 {
            margin: 0;
            text-align: center;
            font-size: 27px;
        }
        .inputs-row {
            width: 100%;
            display: flex;
            padding: 20px 0px;
            .email-input {
                width: 50%;
                float: left;
                input {
                    border-top: 0px;
                    border-left: 0px;
                    border-right: 0px;
                    border-bottom: solid 2px darkgrey;
                    width: 100%;
                    &:focus {
                        outline: none;
                        border-bottom: solid 2px darkseagreen;
                    }
                }
            }
            .user_name-input {
                width: 50%;
                float: right;
                input {
                    border-top: 0px;
                    border-left: 0px;
                    border-right: 0px;
                    border-bottom: solid 2px darkgrey;
                    width: 100%;
                    &:focus {
                        outline: none;
                        border-bottom: solid 2px darkseagreen;
                    }
                }
            }
            .agree-input {
                width: 100%;
                label {
                    font: inherit;
                    padding-left: 10px;
                    width: 97%;
                }
            }
            textarea {
                border-top: 0px;
                border-left: 0px;
                border-right: 0px;
                border-bottom: solid 2px darkgrey;
                width: 100%;
                &:focus {
                    outline: none;
                    border-bottom: solid 2px darkseagreen;
                }
            }
            .error_text {
                font-size: 15px;
                color: red;
            }
            .submit-button {
                border: solid 2px darkgray;
                border-radius: 3px;
                padding: 10px 20px;
                color: darkgray;
                text-decoration: none;
                &:hover {
                    border: solid 2px darkseagreen;
                    color: darkseagreen;
                }
            }
        }
        .message {
            font-size: 30px;
            color: seagreen;
            border: 1px solid;
            border-radius: 4px;
            padding: 14% 20px;
            text-align: center;
            height: 339px;
        }
    }
</style>