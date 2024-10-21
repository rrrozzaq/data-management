# Data Management Laravel Dashboard with Frontend and Restful API for KK (Kartu Keluarga) and KTP (Kartu Tanda Penduduk)

## Overview

This project was developed as part of a recruitment test for PT Efea Inovasi Solusi by Abdul Rozzaq. It is designed to manage Kartu Keluarga (KK) and Kartu Tanda Penduduk (KTP) records, offering functionalities for creating, retrieving, updating, and deleting records within a database. The system supports a 1 to Many relationship between KK and multiple KTP records, reflecting real-world use cases of family documentation management.

### Testing and Integration

- **Postman Testing**: The API has been thoroughly tested using Postman to ensure that all endpoints handle CRUD operations as expected. This includes tests for data integrity, error handling, and response status codes, can be accessed here : [API Documentation](https://documenter.getpostman.com/view/24386185/2sAXxY48R5)
- **Flutter Integration**: The backend has been successfully integrated with a Flutter project, demonstrating its utility in real-world applications. The Flutter project repository can be accessed here: [Github Flutter Project Link](https://github.com/rrrozzaq/data_management)

## Technology Stack

- **Laravel 11**: For the backend API, providing a robust framework for building RESTful APIs.
- **MySQL**: Used for the database to store KK and KTP records securely and efficiently.
- **Docker**: For containerizing the application, ensuring that it runs consistently across different computing environments.
- **Git**: Used for version control, with the project hosted on GitLab, showcasing continuous integration and deployment practices.

## Features

- Comprehensive CRUD functionality for KK and KTP records.
- Docker integration for easy setup and deployment.
- Built with Laravel 11, utilizing its robust framework capabilities for efficient data handling.

## Installation

### Prerequisites

Before you proceed with the installation, ensure you have the following installed on your system:
- Git
- Docker
- Docker Compose

### Steps

1. **Clone the Repository:**

    ```bash
    git clone https://github.com/rrrozzaq/data-management.git
    cd data-management
    ```

2. **Set Up Environment:**

    Copy the sample environment configuration file and edit it according to your environment needs:

    ```bash
    cp .env.example .env
    ```

3. **Edit the .env file to set your database connection and other environment variables:**
    ```.env
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```


4. **Run Docker Compose:**

    Build and start the containers specified in your docker-compose.yml:

    ```bash
    docker-compose up --build
    ```
    
## API Endpoints

### KK Endpoints

- **GET `/api/kk`**
  - Description: Retrieves all KK records.
  - Example Request: `GET https://glacial-castle-88939-9977ca20e3f7.herokuapp.com/api/kk`
  - **Example Response**:
  ```json
  [{"id": 1, "nomor_kk": "64524240", "nama_kepala_keluarga": "Jackson", "alamat": "Jl. Example 123", "..."}]

- **POST `/api/kk`**
  - Description: Adds a new KK record.
  - Example Request: `POST https://glacial-castle-88939-9977ca20e3f7.herokuapp.com/api/kk`
  - Body:
    ```json
    {
      "nomor_kk": "920012349876",
      "nama_kepala_keluarga": "Rahmat Gunadi",
      "alamat": "Jl. Merdeka No. 10, Bandung 40115",
      "tempat_lahir": "Bandung",
      "tanggal_lahir": "1975-08-17",
      "jenis_kelamin": "Laki-Laki",
      "nik": "3509120805750002",
      "agama": "Islam",
      "pendidikan": "S2",
      "pekerjaan": "Dosen Universitas",
      "status_perkawinan": "Kawin",
      "status_hubungan_keluarga": "Kepala Keluarga",
      "kewarganegaraan": "WNI",
      "dokumen_imigrasi": ""
    }

    ```
  - **Example Response**:
    ```json
    {"success": true, "message": "KK added successfully."}
    ``` 
- **GET `/api/kk/{id}`**
  - Description: Retrieves a specific KK record by ID.
  - Example Request: `GET https://glacial-castle-88939-9977ca20e3f7.herokuapp.com/api/kk/1`
  - **Example Response**:
    ```json
    {"id": 1, "nomor_kk": "64524240", "nama_kepala_keluarga": "Jackson", "alamat": "Jl. Example 123", "..."}
    ```

- **PUT `/api/kk/{id}`**
  - Description: Updates a specific KK record.
  - Example Request: `PUT https://glacial-castle-88939-9977ca20e3f7.herokuapp.com/api/kk/1`
  - Body:
    ```json
    {
      "nomor_kk": "12324240",
      "nama_kepala_keluarga": "Jackson Thiago",
      "alamat": "Jl. Updated Example 456",
      "..."
    }

    ```
  - **Example Response**:
    ```json
    {"success": true, "message": "KK updated successfully."}
    ``` 

- **DELETE `/api/kk/{id}`**
  - Description: Deletes a specific KK record.
  - Example Request: `DELETE https://glacial-castle-88939-9977ca20e3f7.herokuapp.com/api/kk/1`
  - **Example Response**:
    ```json
    {"success": true, "message": "KK deleted successfully."}
    ``` 

### KTP Endpoints

- **GET `/api/ktp`**
  - Description: Retrieves all KTP records.
  - Example Request: `GET https://glacial-castle-88939-9977ca20e3f7.herokuapp.com/api/ktp`
  - **Example Response**:
    ```json
    [{"id": 7, "nik": "9876543210987654", "nama": "Jane Doe", "alamat": "Jl. Sudirman", "..."}]
    ``` 

- **POST `/api/ktp`**
  - Description: Adds a new KTP record linked to a KK ID.
  - Example Request: `POST https://glacial-castle-88939-9977ca20e3f7.herokuapp.com/api/ktp`
  - Body:
    ```json
    {
      "nik": "9876543210987654",
      "nama": "Jane Doe",
      "..."
    }
    ```
  - **Example Response**:
    ```json
    {"success": true, "message": "KTP added successfully."}
    ``` 

- **GET `/api/ktp/{id}`**
  - Description: Retrieves a specific KTP record by ID.
  - Example Request: `GET https://glacial-castle-88939-9977ca20e3f7.herokuapp.com/api/ktp/7`
  - **Example Response**:
    ```json
    {"id": 7, "nik": "9876543210987654", "nama": "Jane Doe", "alamat": "Jl. Sudirman", "..."}
    ``` 

- **PUT `/api/ktp/{id}`**
  - Description: Updates a specific KTP record.
  - Example Request: `PUT https://glacial-castle-88939-9977ca20e3f7.herokuapp.com/api/ktp/7`
  - Body:
    ```json
    {
      "nik": "9876543210987654",
      "nama": "Jane Updated",
      "alamat": "Jl. Updated Sudirman 789"
      "..."
    }

    ```
    - **Example Response**:
    ```json
    {"success": true, "message": "KTP updated successfully."}
    ``` 

- **DELETE `/api/ktp/{id}`**
  - Description: Deletes a specific KTP record.
  - Example Request: `DELETE https://glacial-castle-88939-9977ca20e3f7.herokuapp.com/api/ktp/7`
  - **Example Response**:
    ```json
    {"success": true, "message": "KTP updated successfully."}
    ```

# Demo Project

## Accessing the Dashboard

To begin managing your data, first visit the dashboard at:
[Data Management Dashboard](https://glacial-castle-88939-9977ca20e3f7.herokuapp.com/)
![Screenshot 2024-10-22 030530](https://github.com/user-attachments/assets/57cc6359-e85f-4cf4-b474-0a05a16fca9d)
Upon arriving, click the **Kelola Data** button to access the data management features.

## Managing Kartu Keluarga (KK) Data

### Adding KK Data

1. Navigate to the **Kartu Keluarga** page.
   ![Screenshot 2024-10-22 030626](https://github.com/user-attachments/assets/0ae31444-6d49-4244-901f-e4b07109eea6)
2. Click on **Tambah Data Kartu Keluarga** to add new family records.
3. In the form, enter the **Nama Kepala Keluarga** and a unique **Nomor Kartu Keluarga**, etc. This number serves as a unique identifier for the family.

### Viewing, Editing, and Deleting KK Data
![Screenshot 2024-10-22 030758](https://github.com/user-attachments/assets/23583e41-5dc3-46b5-a5af-db9826449cd9)
- Each KK record can be viewed in detail, edited, or deleted. 
- Detailed views allow you to see all associated information and linked KTP records.

## Managing Kartu Tanda Penduduk (KTP) Data

### Adding KTP Data
![Screenshot 2024-10-22 030706](https://github.com/user-attachments/assets/603e4a31-4027-4f8d-90ea-84ce95bcc31b)
1. Move to the **Kartu Tanda Penduduk** page.
2. Press **Tambah Data KTP Baru** to begin adding individual records.
3. **Select a Kartu Keluarga** from the dropdown menu, which contains previously entered KK data, establishing a **1 to Many relationship** between a KK and multiple KTPs (**highlight** this relationship as it is a critical requirement of the recruitment test).
![Screenshot 2024-10-22 030930](https://github.com/user-attachments/assets/a8bdbc3b-e6db-43af-a64b-f4f008530967)
4. Fill in personal details such as Nama, Tempat Lahir, Tanggal Lahir, and others.

### Viewing, Editing, and Deleting KTP Data
![image](https://github.com/user-attachments/assets/3ffccb3b-d583-4968-bf37-7ac03be12770)
- Each KTP entry includes options for detailed viewing, editing, or deletion, ensuring full control over individual records.

## Comprehensive View in Daftar Kartu Keluarga
![Screenshot 2024-10-22 031122](https://github.com/user-attachments/assets/783e65a6-8d13-423a-95da-ae2f960c330c)
- **Daftar Kartu Keluarga** page displays all KK entries along with detailed information about each family member linked through KTP records. This comprehensive view includes details from the head of the family to each member's personal and identification details.

This interactive dashboard allows for efficient and user-friendly management of family and individual records, closely aligning with the project's goals for effective data administration in line with the recruitment test requirements for PT Efea Inovasi Solusi.


## Contributing

Contributions are welcome! Please fork the repository and submit pull requests to contribute.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.


## More Information

For more details about the API, its deployment, and usage, please visit the live API or the GitHub repository:

- [Live API](https://glacial-castle-88939-9977ca20e3f7.herokuapp.com/)
- [GitHub Repository](https://github.com/rrrozzaq/data-management)
