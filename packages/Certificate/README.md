# Pehapkari Ecosystem Tools

## CertificateGenerator

### How to use?

- Open Google Sheets, where:
    - 1st column = name of the lecture
    - 2nd column = date
    - 3rd column = name of the user
    
    ![Certificates Table](/docs/certificates-table.png)
    
- File -> Download As -> CSV
- Run 
    ```bash
    bin/generate-certificate path-to-downloaded-file.csv
    ```
- All certificates will be generated to `/output` directory
