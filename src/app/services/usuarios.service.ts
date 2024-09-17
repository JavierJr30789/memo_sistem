import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { Observable } from 'rxjs';


@Injectable({
  providedIn: 'root'
})
export class UsuariosService {

  url = 'http://localhost/php/';

  constructor(private http: HttpClient) { }

  mostrarTodos(): Observable<any> {
    return this.http.get(`${this.url}mostrarTodos.php`);
  }

  agregar(usuario:any) {
    return this.http.post(`${this.url}agregar.php`, JSON.stringify(usuario));
  }

  eliminar(IdUsuarios: number) {
    return this.http.get(`${this.url}eliminar.php?IdUsuarios=${IdUsuarios}`);
  }

  seleccionar(IdUsuarios: number) {
    return this.http.get(`${this.url}seleccionar.php?IdUsuarios=${IdUsuarios}`);
  }

  update(usuario:any) {
    return this.http.post(`${this.url}update.php`, JSON.stringify(usuario));
  }

}
