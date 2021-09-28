import User from './User';

class Exception {
    handle(error) {
        console.log(error.response.data.error)
        this.isExpired(error.response.data.error)
    }

    isExpired(error) {
        if (error === "Token is now expired") {
            User.loggedOut()
        }
    }
}

export default Exception = new Exception();
