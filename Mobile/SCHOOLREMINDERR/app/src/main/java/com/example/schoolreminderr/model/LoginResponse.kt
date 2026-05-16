package com.example.schoolreminderr.model

data class LoginResponse(
    val status: Boolean,
    val message: String,
    val token: String,
    val data: User
)