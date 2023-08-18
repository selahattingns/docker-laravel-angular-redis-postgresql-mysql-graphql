import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import {PostListService} from "./post-list.service";

@Component({
  selector: 'app-post-list',
  templateUrl: './post-list.component.html',
  styleUrls: ['./post-list.component.scss']
})
export class PostListComponent {
  isMyPost = false;
  posts: any = [];

  constructor(private route: ActivatedRoute, private postListService: PostListService) {}

  ngOnInit(): void {
    this.route.queryParams.subscribe(params => {
      this.getPostList(this.isMyPost = params['filter'] == 'me');
    });
  }

  /**
   *
   * @param isMyPost
   * @param filterTitle
   * @param filterContent
   */
  getPostList(isMyPost: boolean, filterTitle: string = "", filterContent: string = ""){
    this.postListService.getPostList(isMyPost, filterTitle, filterContent).subscribe(
        (response) => {
          this.posts = response;
        }
    );
  }
}
