import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {AuthGuard} from "./guards/auth.guard";

const routes: Routes = [
    { path: '', redirectTo: '/auth/login', pathMatch: 'full' },
    { path: 'auth', loadChildren: () => import('./routes/auth/auth.module').then(m => m.AuthModule) },
    { path: 'pages', loadChildren: () => import('./routes/pages/pages.module').then(m => m.PagesModule), canActivate: [AuthGuard] },
    { path: '**', redirectTo: '/auth/login' },
];

@NgModule({
    imports: [
        RouterModule.forRoot(routes),
    ],
    exports: [RouterModule]
})
export class AppRoutingModule { }
