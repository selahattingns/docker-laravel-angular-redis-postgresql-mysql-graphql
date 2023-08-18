import {NgModule} from "@angular/core";
import {CommonModule} from "@angular/common";
import {FormsModule} from "@angular/forms";
import {RegisterComponent} from "./register/register.component";
import {AuthRoutingModule} from "./auth-routing.module";
import {LoginComponent} from "./login/login.component";
import {ToastrModule} from "ngx-toastr";

@NgModule({
    declarations: [
        LoginComponent,
        RegisterComponent
    ],
    imports: [
        CommonModule,
        AuthRoutingModule,
        FormsModule,
        ToastrModule.forRoot()
    ]
})

export class AuthModule {
}
