import { Component, OnInit } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { PruebaService } from './services/prueba.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Usuario } from './models/usuarios';
import { MatCardModule } from '@angular/material/card';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  imports: [
    FormsModule,
    MatCardModule,
    
  ],  //FormsModule es necesario para ngModel
  standalone: true,
  styleUrls: ['./app.component.css'],
})
export class AppComponent implements OnInit {
  title = 'proyecto';
  registerForm: FormGroup

  connectionStatus = "";

  constructor(private UsuarioService: PruebaService, private fb: FormBuilder) {

    this.registerForm = this.fb.group({
      username: ['', Validators.required],
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required]
    });

  }
  testConnection() {
    this.UsuarioService.testConnection().subscribe({
      next: (response) => {
        this.connectionStatus = response;
      },

      error: (error) => {
        this.connectionStatus = "Error al conectar con la base de datos";
        console.error("Error:", error);
      },
    })
  }
  Usuarios: any;

  user: Usuario = {
    IdUsuario: 0,  
    Name: "",
    Email: "",
    Password: ""
  }
  
  ngOnInit() {
    this.recuperarTodos();
  }

  recuperarTodos() {
    this.UsuarioService.recuperarTodos().subscribe((result: any) => this.Usuarios = result);
  }

  alta() {
    this.UsuarioService.alta(this.user).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  baja(codigo: number) {
    this.UsuarioService.baja(codigo).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  modificacion() {
    this.UsuarioService.modificacion(this.user).subscribe((datos: any) => {
      if (datos['resultado'] == 'OK') {
        alert(datos['mensaje']);
        this.recuperarTodos();
      }
    });
  }

  seleccionar(codigo: number) {
    this.UsuarioService.seleccionar(codigo).subscribe((result: any) => this.user = result[0]);
  }

  hayRegistros() {
    return true;
  }



}
