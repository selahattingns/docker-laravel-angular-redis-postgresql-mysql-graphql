import { Component } from '@angular/core';
import {LoginService} from "./login.service";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {
    constructor(private loginService: LoginService) {}

    ngOnInit(): void {
        this.loginService.loginUser('selahattin.gunes.5@gmail.com', '12341234').subscribe(
            (response) => {
                localStorage.setItem('token', response.access_token)
            }
        );
    }
}
