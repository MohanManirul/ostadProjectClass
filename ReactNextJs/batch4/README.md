# Chat API Documentation

This document provides comprehensive documentation for the Chat API endpoints and instructions for students to build a chat application.

## Project Overview

Your task is to build a chat application using this API. The API provides endpoints for:

- User authentication
- Individual and group chats
- Message management
- File uploads
- Message status tracking (sent/delivered/seen)

## Base URL

```
https://moonlit-boba-f07668.netlify.app/api
```

## Authentication

All API endpoints (except login/register) require authentication using JWT tokens.

Include the token in the Authorization header:

```
Authorization: Bearer <your_token>
```

### Register User

- **POST** `/auth/register`
- **Body:**
  ```json
  {
    "username": "string",
    "password": "string"
  }
  ```
- **Response:**
  ```json
  {
    "id": "uuid",
    "username": "string",
    "createdAt": "timestamp"
  }
  ```

### Login

- **POST** `/auth/login`
- **Body:**
  ```json
  {
    "username": "string",
    "password": "string"
  }
  ```
- **Response:**
  ```json
  {
    "token": "jwt_token"
  }
  ```

## Chats

### Create Chat

- **POST** `/chats`
- **Body:**
  ```json
  {
    "name": "string (optional for group chats)",
    "participants": ["user_id1", "user_id2"],
    "type": "individual" | "group"
  }
  ```
- **Response:**
  ```json
  {
    "id": "uuid",
    "name": "string",
    "type": "individual" | "group",
    "participants": ["user_id1", "user_id2"],
    "createdBy": "user_id",
    "createdAt": "timestamp"
  }
  ```

### List Chats

- **GET** `/chats`
- **Response:**
  ```json
  [
    {
      "id": "uuid",
      "name": "string",
      "type": "individual" | "group",
      "participants": ["user_id1", "user_id2"],
      "createdAt": "timestamp"
    }
  ]
  ```

## Messages

### Send Message

- **POST** `/messages`
- **Body:**
  ```json
  {
    "chatId": "uuid",
    "content": "string",
    "type": "text" | "image" | "file"
  }
  ```
- **Response:**
  ```json
  {
    "id": "uuid",
    "chatId": "uuid",
    "senderId": "user_id",
    "content": "string",
    "type": "text" | "image" | "file",
    "status": "sent",
    "createdAt": "timestamp",
    "seenBy": []
  }
  ```

### Get Chat Messages

- **GET** `/messages?chatId=<chat_id>`
- **Response:**
  ```json
  [
    {
      "id": "uuid",
      "chatId": "uuid",
      "senderId": "user_id",
      "content": "string",
      "type": "text" | "image" | "file",
      "status": "sent" | "delivered" | "seen",
      "createdAt": "timestamp",
      "seenBy": ["user_id1", "user_id2"]
    }
  ]
  ```

## File Upload

### Upload File

- **POST** `/upload`
- **Body:** FormData with 'file' field
- **Limitations:**
  - Maximum file size: 50KB
- **Response:**
  ```json
  {
    "url": "string",
    "fileName": "string",
    "size": "number",
    "type": "string"
  }
  ```

## Student Task Requirements

1. Create a chat application using any React template or build your own UI
2. Implement the following features:

   - User registration and login
   - Display list of chats (individual and group)
   - Create new individual and group chats
   - Send and receive messages
   - Upload and share files/images
   - Show message status (sent/delivered/seen)
   - Display user online/offline status

3. Technical Requirements:

   - Use React for the frontend
   - Implement proper error handling
   - Show loading states during API calls
   - Implement proper form validation
   - Use proper TypeScript types
   - Follow React best practices

4. Evaluation Criteria:
   - Correct implementation of API integration
   - Code organization and cleanliness
   - Error handling
   - TypeScript usage
   - Overall functionality
   - UI/UX is not the main focus but should be usable

## Notes

- Each student will have their own user account, ensuring data isolation
- The API uses file-based storage, so data persistence is guaranteed
- All endpoints return proper error messages when something goes wrong
- File upload is limited to 50KB to prevent abuse
- The API is hosted on Vercel for reliability

## Getting Started

1. Register a new user account
2. Use the returned token for all subsequent requests
3. Create or join chats
4. Start sending messages
5. Implement real-time updates using polling (every 3-5 seconds)

Good luck with your implementation!
