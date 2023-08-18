import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { API_URL } from '../../../configs/app.constants';

@Injectable({
    providedIn: 'root'
})
export class RegisterService {

    /**
     *
     * @param http
     */
    constructor(private http: HttpClient) { }

    /**
     *
     * @param firstname
     * @param lastname
     * @param email
     * @param password
     * @param password_confirmation
     */
    registerUser(firstname: string, lastname: string, email: string, password: string, password_confirmation: string): Observable<any> {
        return this.http.post(`${API_URL}/register`, {
            firstname: firstname,
            lastname: lastname,
            email: email,
            password: password,
            password_confirmation: password_confirmation
        });
    }
}
