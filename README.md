Question 1

Start by cloning the project

1. Open terminal/command prompt
2. Change directory into the project
3. Execute the command 'docker-compose up -d'
4. Head over to 'http://localhost:8001'
5. Change the port in docker-compose.yml to use a different port

-----------------------

Question 2

My suggestion would be as below

- For columns that are heavily search such as when searching through Datatable should use the FULL TEXT indexing,
- Full Text indexing improves the like '%%' condition
- Select ONLY the column that are needed when querying to minimize full column scans
- Index all columns that may be used in WHERE, ORDER BY, GROUP BY
   
