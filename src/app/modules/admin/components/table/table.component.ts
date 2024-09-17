import { Component, OnInit } from '@angular/core';
import { UsuariosService } from 'src/app/services/usuarios.service';
import { NgForm } from '@angular/forms';
import { HttpClient } from '@angular/common/http'


@Component({
  selector: 'app-table',
  templateUrl: './table.component.html',
  styleUrls: ['./table.component.scss']
})
export class TableComponent implements OnInit {
  title = 'pruebacrud';
  usuario: any;

  user = {
    IdUsuarios: 0,
    IdGrupo: 0,
    NombreUsuario: "",
    Mail: "",
    Clave: "",
  }

  constructor(private usuariosService: UsuariosService) { }

  ngOnInit() {
    this.MostrarTodos();
  }

  hayRegistros() {
    return true;
  }

  MostrarTodos() {
    this.usuariosService.mostrarTodos().subscribe(result => this.usuario = result);
  }

  Agregar() {
    this.usuariosService.agregar(this.user).subscribe((datos:any) => {
      if (datos['resultado'] === 'OK') {
        alert(datos['mensaje']);
        this.MostrarTodos();
      }

    });
  }
  
  Eliminar(IdUsuarios:number) {
    this.usuariosService.eliminar(IdUsuarios).subscribe((datos:any) => {
      if (datos['resultado'] === 'OK') {
        alert(datos['mensaje']);
        this.MostrarTodos();
      }
    });
  }

  Modificar() {
    console.log("se presiono modificar");
    this.usuariosService.update(this.user).subscribe((datos:any) => {
      if (datos['resultado'] === 'OK') {
        alert(datos['mensaje']);
        this.MostrarTodos();
      }

    });
  }

  Seleccionar(IdUsuarios:number) {
    this.usuariosService.seleccionar(IdUsuarios).subscribe((datos:any) =>
      this.user = datos[0]);
  }


}