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
  filterTitle = "";
  filterContent = "";
  posts: any = [];

  constructor(private route: ActivatedRoute, private postListService: PostListService) {}

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
    this.postListService.getPostList(this.isMyPost, this.filterTitle, this.filterContent).subscribe(
        (response) => {
          this.posts = response;
        }
    );
  }
}
