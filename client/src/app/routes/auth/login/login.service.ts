import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { API_URL } from '../../../configs/app.constants';

@Injectable({
    providedIn: 'root'
})
export class LoginService {

    /**
     *
     * @param http
     */
    constructor(private http: HttpClient) { }

    /**
     *
     * @param email
     * @param password
     */
    loginUser(email: string, password: string): Observable<any> {
        return this.http.post(`${API_URL}/login`, { email: email, password: password });
    }
}
