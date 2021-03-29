import { Component, OnInit, ViewEncapsulation } from '@angular/core';
declare const daisyjs: any;

@Component({
  selector: 'app-Index',
  templateUrl: './Index.component.html',
  styleUrls: ['./Index.component.css'],
  encapsulation: ViewEncapsulation.None
})
export class IndexComponent implements OnInit {

  constructor() { }

  ngOnInit() {
    document.addEventListener(
      "DOMContentLoaded", () => {
        daisyjs(document.getElementById("nains"), {
          dotColor: "#4eaaf9",
          lineColor: "#4eaaf9",
        });
      },
      false
    );

  }

}
