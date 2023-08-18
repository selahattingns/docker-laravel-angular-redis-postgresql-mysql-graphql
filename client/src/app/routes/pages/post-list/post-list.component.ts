import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import {PostService} from "./post.service";
import {ToastrService} from "ngx-toastr";

@Component({
  selector: 'app-post-list',
  templateUrl: './post-list.component.html',
  styleUrls: ['./post-list.component.scss']
})
export class PostListComponent {
  isMyPost = false;
  newTitle = "";
  newContent = "";
  filterTitle = "";
  filterContent = "";
  posts: any = [];

  constructor(private route: ActivatedRoute, private postService: PostService, private toastr: ToastrService) {}

  ngOnInit(): void {
    this.route.queryParams.subscribe(params => {
      this.isMyPost = params['filter'] == 'me';
      this.getPostList();
    });
  }

  /**
   *
   */
  getPostList(){
    this.postService.getPostList(this.isMyPost, this.filterTitle, this.filterContent).subscribe(
        (response) => {
               this.posts = response;
             }
    );
  }

  /**
   *
   * @param post
   */
  deletePost(post: any){
    this.postService.deletePost(post.id).subscribe(
        (response) => {
          this.toastr.success('success', 'post deleted.');
          this.getPostList();
        }
    );
  }

  /**
   *
   */
  storePost(){
    this.postService.storePost(this.newTitle, this.newContent).subscribe(
        (response) => {
          this.toastr.success('success', 'post added.');
          this.getPostList();
          this.newTitle = "";
          this.newContent = "";
        }
    );
  }

  /**
   *
   * @param post
   */
  updatePost(post: any){
      this.postService.updatePost(post.id, post.title, post.content).subscribe(
          (response) => {
              this.toastr.success('success', 'post updated.');
          }
      );
  }
}
