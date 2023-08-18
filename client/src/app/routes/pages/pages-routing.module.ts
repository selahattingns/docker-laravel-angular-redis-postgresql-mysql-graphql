import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {HomepageComponent} from "./homepage/homepage.component";
import {PostListComponent} from "./post-list/post-list.component";
import {CommentListComponent} from "./comment-list/comment-list.component";


const routes: Routes = [
    {
        path: 'homepage',
        component: HomepageComponent
    },
    {
        path: 'post-list',
        component: PostListComponent
    },
    {
        path: 'comment-list/:post_id',
        component: CommentListComponent
    },
];

@NgModule({
    imports: [
        RouterModule.forChild(routes),
    ],
    exports: [RouterModule]
})
export class PagesRoutingModule { }
