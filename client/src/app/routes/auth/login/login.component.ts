import { Component } from '@angular/core';
import {LoginService} from "./login.service";
import {Router} from "@angular/router";
import {LayoutService} from "../../layouts/layout.service";
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {

    email: any;
    password: any;

    /**
     *
     * @param loginService
     * @param router
     * @param layoutService
     * @param toastr
     */
    constructor(private loginService: LoginService, private router: Router, private layoutService: LayoutService, private toastr: ToastrService) {}

    ngOnInit(): void { }

    login(){
        let thisClass = this;
        this.loginService.loginUser(this.email, this.password).subscribe(
            (response) => {
                localStorage.setItem('token', response.access_token);
                thisClass.layoutService.setLayoutData({isLogout: false});
                thisClass.toastr.success('Success', 'logged in');
                thisClass.router.navigate(['/pages/homepage']);
            }
        );
    }
}
