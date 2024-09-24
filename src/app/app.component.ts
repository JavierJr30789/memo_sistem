import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DatabaseService } from './database.service';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';

interface User {
  id?: number;
  name: string;
  email: string;
}

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule, HttpClientModule, FormsModule],
  template: `
    <h1>CRUD de Usuarios</h1>
    
    <h2>Crear Usuario</h2>
    <form (ngSubmit)="createUser()">
      <input [(ngModel)]="newUser.name" name="name" placeholder="Nombre">
      <input [(ngModel)]="newUser.email" name="email" placeholder="Email">
      <button type="submit">Crear</button>
    </form>

    <h2>Lista de Usuarios</h2>
    <ul>
      <li *ngFor="let user of users">
        {{ user.name }} ({{ user.email }})
        <button (click)="deleteUser(user.id)">Eliminar</button>
        <button (click)="selectUserForUpdate(user)">Actualizar</button>
      </li>
    </ul>

    <h2 *ngIf="selectedUser">Actualizar Usuario</h2>
    <form *ngIf="selectedUser" (ngSubmit)="updateUser()">
      <input [(ngModel)]="selectedUser.name" name="updateName" placeholder="Nombre">
      <input [(ngModel)]="selectedUser.email" name="updateEmail" placeholder="Email">
      <button type="submit">Actualizar</button>
    </form>
  `
})
export class AppComponent implements OnInit {
  users: User[] = [];
  newUser: User = { name: '', email: '' };
  selectedUser: User | null = null;

  constructor(private databaseService: DatabaseService) {}

  ngOnInit() {
    this.loadUsers();
  }

  loadUsers() {
    this.databaseService.getUsers().subscribe(users => this.users = users);
  }

  createUser() {
    this.databaseService.createUser(this.newUser).subscribe(() => {
      this.loadUsers();
      this.newUser = { name: '', email: '' };
    });
  }

  deleteUser(id: number | undefined) {
    if (id) {
      this.databaseService.deleteUser(id).subscribe(() => this.loadUsers());
    }
  }

  selectUserForUpdate(user: User) {
    this.selectedUser = { ...user };
  }

  updateUser() {
    if (this.selectedUser) {
      this.databaseService.updateUser(this.selectedUser).subscribe(() => {
        this.loadUsers();
        this.selectedUser = null;
      });
    }
  }
}