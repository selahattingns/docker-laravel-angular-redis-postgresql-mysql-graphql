import { Injectable } from '@angular/core';
import {HttpClient, HttpParams} from '@angular/common/http';
import { Observable } from 'rxjs';
import { API_URL } from '../../../configs/app.constants';

@Injectable({
    providedIn: 'root'
})
export class PostListService {

    /**
     *
     * @param http
     */
    constructor(private http: HttpClient) { }

    /**
     *
     * @param isMyPost
     * @param filterTitle
     * @param filterContent
     */
    getPostList(isMyPost: boolean, filterTitle: string = "", filterContent: string = ""): Observable<any> {
        let params = new HttpParams();
        params = params.append('is_my_post', isMyPost);
        params = params.append('title', filterTitle);
        params = params.append('content', filterContent);

        return this.http.get(`${API_URL}/pages/posts`, {params: params});
    }
}