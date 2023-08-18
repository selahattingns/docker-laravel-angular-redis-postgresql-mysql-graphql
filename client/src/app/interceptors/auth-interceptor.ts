import { Injectable } from '@angular/core';
import {
    HttpInterceptor,
    HttpRequest,
    HttpHandler,
    HttpEvent, HttpErrorResponse,
} from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import {ToastrService} from "ngx-toastr";


@Injectable()
export class AuthInterceptor implements HttpInterceptor {
    constructor(private toastr: ToastrService){}

    intercept(
        request: HttpRequest<any>,
        next: HttpHandler
    ): Observable<HttpEvent<any>> {

        const modifiedRequest = request.clone({

            setHeaders: {
                Authorization: 'Bearer ' + localStorage.getItem('token'),
            },
        });
        let thisClass = this;
        return next.handle(modifiedRequest).pipe(
            catchError((error: HttpErrorResponse) => {
                if (error.error.errors){
                    Object.keys(error.error.errors).forEach(key => {
                        thisClass.toastr.error('Error', error.error.errors[key][0]);
                    });
                }else if (error.error){
                    thisClass.toastr.error('Error', error.error.error);
                }

                return throwError(error);
            })
        );
    }
}
