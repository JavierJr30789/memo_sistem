import { Component, OnInit } from '@angular/core';
import { APIService } from '../service/api.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

  data: any []  =  [];

  constructor (private apiService: APIService) { }

  ngOninit (): void {
    this.llenarData ()
  }

  llenarData () {
    this.apiService.getData().subscribe( data => {
      this.data = data;
      console.log(this.data);
    } 

    )
  }
}
