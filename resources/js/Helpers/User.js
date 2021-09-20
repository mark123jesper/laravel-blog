import Token from "./Token";
import AppStorage from "./AppStorage";

class User {
    login(data) {
        axios.post('api/auth/login', data)
            .then(res => this.loginResponse(res))
            .catch(error => console.log(error))
    }

    loginResponse(res) {
        const access_token = res.data.access_token;
        const username = res.data.user
        if (Token.isValid(access_token)) {
            AppStorage.store(username, access_token);
            window.location = '/forum';
        }
    }

    hasToken() {
        const storedToken = AppStorage.getToken();
        if (storedToken) {
            return Token.isValid(storedToken) ? true : this.logout()
        }
        return false
    }

    loggedIn() {
        return this.hasToken();
    }

    loggedOut() {
        AppStorage.clear();
        window.location = '/forum';
    }

    getName() {
        if (this.loggedIn) {
            return AppStorage.getUser();
        }
    }

    getId() {
        if (this.loggedIn()) {
            const payload = Token.payload(AppStorage.getToken())
            return payload.sub
        }
    }

    own(id) {
        return this.getId() == id
    }

    admin() {
        return this.getId() == 11
    }
}

export default User = new User();
