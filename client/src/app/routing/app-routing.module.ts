import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {LoginComponent} from "../routes/auth/login/login.component";
import {RegisterComponent} from "../routes/auth/register/register.component";
import {HomepageComponent} from "../routes/pages/homepage/homepage.component";
import {AuthGuard} from "../guards/auth.guard";

const pages: Routes = [
    { path: 'homepage', component: HomepageComponent },
];

const routes: Routes = [
    { path: '', redirectTo: '/login', pathMatch: 'full' },
    { path: '**', redirectTo: '/login' },
    { path: 'login', component: LoginComponent },
    { path: 'register', component: RegisterComponent },
    { path: 'pages', children: pages, canActivate: [AuthGuard]}

];

@NgModule({
    imports: [
        RouterModule.forRoot(routes)
    ],
    exports: [RouterModule]
})
export class AppRoutingModule { }
