# PrivateStream

PrivateStream is a web-based streaming service designed to provide secure access to content. By incorporating token validation, the system ensures that only authenticated users can stream content, effectively safeguarding private content on the platform.

## Features

- **Token Validation**: Ensures secure access by validating user tokens.
- **Authenticated Streaming**: Only authenticated users can access and stream content.
- **Secure Platform**: Protects private content from unauthorized access.

## Installation

To get started with PrivateStream, follow these steps:

1. Create MySQL database with log and token table
   ```
     CREATE TABLE `log` (
      `log` int NOT NULL,
      `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
      `action` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
      `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `ip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
      `session` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'session',
      `userag` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'userag'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE `token` (
      `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
      `ip` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
      `used` int DEFAULT '0',
      `resetcount` int NOT NULL DEFAULT '10',
      `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Name',
      `session` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'session',
      `userag` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'userag'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

     ALTER TABLE `log`
      ADD PRIMARY KEY (`log`);
  
    ALTER TABLE `token`
      ADD PRIMARY KEY (`token`);
      
    ALTER TABLE `log`
      MODIFY `log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2766;
   ```

2. Create a token on log table.
## Usage

[WIP]

## Configuration

### Environment Variables

To configure the application, set the database connection on adm/otor.php.

## Contact

For any inquiries, please contact [ryandionenatan@yahoo.co.id].
