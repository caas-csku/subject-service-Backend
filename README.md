# Subject-Service (Docker)

## Setup

1. สร้าง folder สำหรับ Database Mysql => `mkdir mysql`
2. สั่งสร้าง image และ container ตามลำดับ => ``docker-compose build && docker-compose up -d``
3. เช็คว่า container run ทุกตัวหรือไม่ => ``docker ps``
4. เข้าไปใน ./src แล้ว =>
* ```
    composer update
    cp .env.example .env
    php artisan key:generate
    ```
* ในขั้นตอนนี้สามารถใช้ ``docker-compose exec php`` เพื่อเข้าไปใช้ command ในเครื่อง docker แทนได้เช่น ``docker-compose exec php php artisan key:generate``

5. ลองเข้าไปที่ http://localhost:8088 เพื่อดูผลลัพธ์

## Migrate 

1. เข้าไปแก้ไข .env ให้ DB_HOST=mysql เพื่อเชื่อมกับ container mysql
2. นำค่าของ environment ของ mysql มาใส่ลงใน .env (DB_DATABASE, DB_DATABASE, DB_PASSWORD)
3. สั่ง ``docker-compose exec php php artisan migrate`` เพื่อ migrate ตารางใน Mysql container
4. ลองเรียก API 
    * `get all` http://localhost:8088/api/subject
    
    * `post` http://localhost:8088/api/subject
   
    * `get 1` http://localhost:8088/api/subject/```<code-year>``` ex /api/subject/
    01418112-60
    
    * `update` http://localhost:8088/api/subject/```<id>``` ex /api/subject/1
    
        * Request => ['(str) code', '(str) name_th', '(str) name_en', '(int) year']
    
    * `delete` http://localhost:8088/api/subject/```<code-year>``` ex /api/subject/01418112-60 


## structure
```
.
|-- mysql => ที่เก็บ Database
|
|-- nginx => webserve
|     |-- default.conf => config websever
|
|-- src => !edit in here
|    |-- pubilc => ตัวเริ่มจำเป็นต้องมี index.php หรือ index.html
|
|-- Dockerfile
|-- docker-compose.yml
```