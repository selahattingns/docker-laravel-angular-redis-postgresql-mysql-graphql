import {NgModule} from "@angular/core";
import {CommonModule} from "@angular/common";
import {FormsModule} from "@angular/forms";
import {ToastrModule} from "ngx-toastr";
import {PagesRoutingModule} from "./pages-routing.module";
import { PostListComponent } from './post-list/post-list.component';

@NgModule({
  declarations: [
    PostListComponent
  ],
    imports: [
        CommonModule,
        PagesRoutingModule,
        FormsModule,
        ToastrModule.forRoot()
    ]
})

export class PagesModule {
}
