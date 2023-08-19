import { Injectable } from '@angular/core';
import {HttpClient, HttpParams} from '@angular/common/http';
import { Observable } from 'rxjs';
import { API_URL } from '../../../configs/app.constants';

@Injectable({
    providedIn: 'root'
})
export class CommentService {

    /**
     *
     * @param http
     */
    constructor(private http: HttpClient) { }

    /**
     *
     * @param postId
     * @param filterContent
     */
    getCommentList(postId: string, filterContent: string = ""): Observable<any> {
        let params = new HttpParams();
        params = params.append('post_id', postId);
        params = params.append('content', filterContent);

        return this.http.get(`${API_URL}/pages/comments`, {params: params});
    }

    /**
     *
     * @param postId
     * @param newContent
     */
    storeComment(postId: number, newContent:string){
        return this.http.post(`${API_URL}/pages/comments`, {post_id: postId, content: newContent});
    }

    /**
     *
     * @param id
     */
    deleteComment(id: number){
        return this.http.delete(`${API_URL}/pages/comments/` + id);
    }

    /**
     *
     * @param id
     * @param content
     */
    updateComment(id: number, content: string){
        return this.http.patch(`${API_URL}/pages/comments`, {comment_id: id, content: content});
    }
}
