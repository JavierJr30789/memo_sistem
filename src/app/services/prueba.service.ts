import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http'
@Injectable({
  providedIn: 'root'
})

export class PruebaService {

  private url = 'http://localhost/api'; // disponer url de su servidor que tiene las páginas PHP

  constructor(private http: HttpClient) { }

  testConnection(): Observable<string> {
    return this.http.get(`${this.url}/test-connection`, { responseType: 'text' });
  }

  recuperarTodos() {
    return this.http.get(`${this.url}recuperartodos.php`);
  }

  alta(Usuarios: any) {
    return this.http.post(`${this.url}alta.php`, JSON.stringify(Usuarios));
  }

  baja(IdUsuarios: number) {
    return this.http.get(`${this.url}baja.php?codigo=${IdUsuarios}`);
  }

  seleccionar(IdUsuarios: number) {
    return this.http.get(`${this.url}seleccionar.php?IdUsuarios=${IdUsuarios}`);
  }

  modificacion(Usuarios: any) {
    return this.http.post(`${this.url}modificacion.php`, JSON.stringify(Usuarios));
  }
}
