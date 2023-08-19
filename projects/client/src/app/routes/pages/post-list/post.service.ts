import { Injectable } from '@angular/core';
import {HttpClient, HttpParams} from '@angular/common/http';
import { Observable } from 'rxjs';
import { API_URL } from '../../../configs/app.constants';

@Injectable({
    providedIn: 'root'
})
export class PostService {

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
     * @param filterTag
     */
    getPostList(isMyPost: boolean, filterTitle: string = "", filterContent: string = "", filterTag: string = ""): Observable<any> {
        let params = new HttpParams();
        params = params.append('is_my_post', isMyPost);
        params = params.append('title', filterTitle);
        params = params.append('content', filterContent);
        params = params.append('tag', filterTag);

        return this.http.get(`${API_URL}/pages/posts`, {params: params});
    }

    /**
     *
     * @param newTitle
     * @param newContent
     */
    storePost(newTitle: string, newContent:string){
        return this.http.post(`${API_URL}/pages/posts`, {title: newTitle, content: newContent});
    }

    /**
     *
     * @param id
     */
    deletePost(id: number){
        return this.http.delete(`${API_URL}/pages/posts/` + id);
    }

    /**
     *
     * @param postId
     * @param title
     * @param content
     */
    updatePost(postId: number, title: string, content: string){
        return this.http.patch(`${API_URL}/pages/posts`, {post_id: postId, title: title, content: content});
    }
}
