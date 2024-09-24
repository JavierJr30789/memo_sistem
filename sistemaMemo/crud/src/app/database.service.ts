import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class DatabaseService {
  private apiUrl = 'http://localhost/api';

  constructor(private http: HttpClient) { }

  alta(usuarioData: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/alta/usuario.php`, usuarioData);
  }

  recuperar(): Observable<any> {
    return this.http.get(`${this.apiUrl}/recuperartodos/usuario.php`);
  }

  baja(IdUsuarios: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/baja/usuario.php?IdUsuarios=${IdUsuarios}`);
  }
  
  // Nuevo método para modificar un usuario
  modificar(usuario: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/modificacion/usuario.php`, usuario);
  }
}

