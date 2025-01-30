import { UserType } from "../enums/user-type.enum";

interface Entity {
    id: number;
    name: string;
    email: string;
    role: UserType;
}

export default class User implements Entity {
    id: number;
    name: string;
    email: string;
    role: UserType;
    constructor(user: Entity) {
        this.id = user.id;
        this.name = user.name;
        this.email = user.email;
        this.role = user.role;
    }

    signIn(token: string) {
        try {
            if (!token && !token.length) throw new Error("Token required.");

            localStorage.setItem("user", JSON.stringify(this));
            localStorage.setItem("token", token);
            return true;
        } catch (error) {
            console.error("error =>", error);
        }
    }

    logout() {
        try {
            localStorage.removeItem("token");
            localStorage.removeItem("user");
            return true;
        } catch (error) {
            console.log("error =>", error);
        }
    }

    static getCurrentUser() {
        try {
            const result = localStorage.getItem("user");
            if (!result) throw new Error("User not logged in");
            const entity = JSON.parse(result);
            return new User(entity);
        } catch (error) {
            console.error("error =>", error);
        }
    }
}
