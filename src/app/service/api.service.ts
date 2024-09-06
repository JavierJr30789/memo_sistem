import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class APIService {

  private urlApi = 'localhost:3000'; //link

  constructor(private http: HttpClient) {  } 

  public getData () : Observable  <any> {
    return this.http.get<any>(this.urlApi)
  }

}
