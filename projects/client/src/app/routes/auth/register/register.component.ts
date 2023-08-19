import { Component } from '@angular/core';
import {RegisterService} from "./register.service";
import {ToastrService} from "ngx-toastr";
import {Router} from "@angular/router";

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent {
  firstname: any;
  lastname: any;
  email: any;
  password: any;
  password_confirmation: any;

  /**
   *
   * @param registerService
   * @param router
   * @param toastr
   */
  constructor(private registerService: RegisterService, private router: Router, private toastr: ToastrService){ }

  register(){
    let thisClass = this;

    this.registerService.registerUser(
        this.firstname,
        this.lastname,
        this.email,
        this.password,
        this.password_confirmation
    ).subscribe(
        (response) => {
          thisClass.toastr.success('Success', 'User registered successfully');
          thisClass.router.navigate(['/pages/homepage']);
        }
    );
  }
}
