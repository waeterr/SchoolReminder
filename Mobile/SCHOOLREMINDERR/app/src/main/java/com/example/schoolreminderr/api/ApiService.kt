package com.example.schoolreminderr.api

import com.example.schoolreminderr.model.LoginRequest
import com.example.schoolreminderr.model.LoginResponse
import retrofit2.Call
import retrofit2.http.Body
import retrofit2.http.POST

interface ApiService {

    @POST("login")
    fun login(@Body request: LoginRequest): Call<LoginResponse>
}