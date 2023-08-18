import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {RegisterComponent} from "./routes/auth/register/register.component";
import {HomepageComponent} from "./routes/pages/homepage/homepage.component";
import {AuthGuard} from "./guards/auth.guard";

const pages: Routes = [
    { path: 'homepage', component: HomepageComponent },
];

const routes: Routes = [
    { path: '', redirectTo: '/auth/login', pathMatch: 'full' },
    {
      path: 'auth', loadChildren: () => import('./routes/auth/auth.module').then(m => m.AuthModule)
    },
    {
      path: 'pages',
      children: pages,
      canActivate: [AuthGuard]
    },
    { path: '**', redirectTo: '/auth/login' },

];

@NgModule({
    imports: [
        RouterModule.forRoot(routes),
    ],
    exports: [RouterModule]
})
export class AppRoutingModule { }
