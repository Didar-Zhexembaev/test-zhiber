import api from '../api';

export default {
    methods: {
        request(url, method, data = {}) {
            return api.get("csrf-cookie").then(
                    () => method == 'post'
                    ? api.post(url, data)
                    : api.get(url)
                );
        },
        signin(values) {
            return this.request('signin', 'post', values)
            .then((response) => {
                if (response.data.success) {
                    this.toast('success', response.data.message);
                    this.$store.dispatch('logged', true)
                        .then(() => this.$cookies.set('authorized', true));
                    this.$router.push({ name: 'home' });
                } else {
                    this.$store.dispatch('flashMessage', response.data.message);
                }
            })
            .catch((error) => {
                this.$store.dispatch('flashMessage', error.response.data.message)
                this.clearCookies('signin');
            });
        },
        signout(e) {
            e.preventDefault();
            this.loading = true;
            this.request('signout', 'get')
            .then((response) => {
                if (response.data.success) {
                    this.toast('success', response.data.message);
                    this.$store.dispatch('logged', false)
                        .then(() => {
                            this.clearCookies();
                        });
                } else {
                    form.error = response.data.message;
                }
            })
            .catch((error) => {
                if (error.response.status == 401) {
                    this.clearCookies('signin');
                }
            })
            .finally(() => this.loading = false);
        },
        signup(values, actions) {
            return this.request('signup', 'post', values)
            .then((response) => {
                if (response.data.success) {
                    this.toast('success', response.data.message);
                    this.$store.dispatch('logged', true)
                        .then(() => this.$cookies.set('authorized', true));
                    this.$router.push({ name: 'home' });
                } else {
                    this.$store.dispatch('flashMessage', response.data.message);
                }

                actions.resetForm();
            })
            .catch((error) => {
                this.$store.dispatch('flashMessage', error.response.data.message)
                this.clearCookies('signup');
            });
        },
        fetchReportFormData() {
            if (this.$store.getters.formData) {
                return;
            }
            
            this.request('report/form', 'post')
            .then((response) => {
                if (response.data.success) {
                    this.$store.dispatch('formData', response.data.data);
                }
            })
            .catch((error) => {
                if (error.response.status == 401) {
                    this.clearCookies('signin');
                }
            })
        },
        report(values, actions) {
            // convert to timestamp
            values.dateTime = new Date(values.dateTime).getTime() / 1000;
            // convert number input[type="number"]
            if (values.weight) {
                values.weight = Number(values.weight);
            }
            return this.request('report', 'post', values)
            .then((response) => {
                this.$swal(response.data.message, '', response.data.success ? 'success' : 'error');
                actions.resetForm();
            })
            .catch((error) => {
                if (error.response.status == 401) {
                    this.clearCookies('signin');
                } else {
                    this.$swal(error.response.data.message, '', 'error')
                }
            });
        },
        reportAll() {
            return !this.$store.getters.allReports && this.request('report/all')
            .then((response) => {
                this.$store.dispatch('allReports', response.data);
            })
            .catch((error) => {
                if (error.response.status == 401) {
                    this.clearCookies('signin');
                } else {
                    this.$swal(error.response.data.message, '', 'error')
                }
            });
        },
        isLogged() {
            return this.$store.getters.auth.isLogged;
        },
        togglePassword(showPassword) {
            return showPassword ? "text" : "password";
        },
        toast(icon, title, timer = 3000) {
            this.$swal({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', this.$swal.stopTimer)
                  toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                icon,
                title,
            });
        },
        clearCookies(routeName) {
            this.$cookies.remove('authorized');
            this.$cookies.remove('XSRF-TOKEN');
            if (routerName) {
                this.$router.go({name: routeName});
            }
        }
    }
};