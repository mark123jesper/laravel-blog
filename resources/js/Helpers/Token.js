class Token {

    isValid(token) {
        const payload = this.payload(token);
        if (payload !== undefined && payload !== null) {
            return payload.iss == "http://laravelblog.test/api/auth/login" || "http://laravelblog.test/api/auth/signup" ? true : false
        }
        return false
    }

    payload(token) {
        const payload = token.split('.')[1]
        return this.decode(payload)
    }

    decode(payload) {
        if (this.isBase64(payload)) {
            return JSON.parse(window.atob(payload))
        }
        return false;
    }

    isBase64(str) {
        try {
            return window.btoa(window.atob(str)).replace(/=/g, "") == str
        }
        catch (err) {
            return false
        }
    }
}

export default Token = new Token();
