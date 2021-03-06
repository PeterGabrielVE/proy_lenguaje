ALTER TABLE `contractors`
  ADD COLUMN `Con_Afiliations` VARCHAR(250) NOT NULL,
  ADD COLUMN `Con_Cell_Phone2` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_DBA_Name` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_DBA_SSN` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_DBA_DBO` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_DBA_oOuntry` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_E_mail_Address_2` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_E_mail_Address_3` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_Field_Expertise` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Expertise_Certifications` VARCHAR(500) NOT NULL,
  ADD COLUMN `Con_Initial` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Interpreter_Status` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Mailing_Address` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_MA_City` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_MA_State` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_MA_County` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_MA_Zip_Code` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_Payment_Method` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Payment_Decision` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Physical_Address` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_Other_Phone` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Services` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_Title` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_Services_Offered` VARCHAR(100) NOT NULL
  ADD COLUMN `Con_Rate_Interpret_Medical_PerHour` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Medical_Minimum` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Medical_Mile` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Medical_NoShow` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Medical_Cancelation` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Medical_Rush` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Medical_TravelTime` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Medical_Other` longtext NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Legal_PerHour` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Legal_Medium` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Legal_FullDay` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Legal_PerMile` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Legal_Cancelation_PerHour` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Legal_Cancelation_Medium` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Legal_Cancelation_FullDay` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Legal_TravelTime` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Legal_NoShow_Medium` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_Legal_NoShow_FullDay` VARCHAR(50) NOT NULL
  ADD COLUMN `Con_Rate_Interpret_Legal_Other` longtext NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_School_PerHour` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_School_Minimum` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_School_PerMile` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_School_NoShow` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_School_Cancelation` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_School_TravelTime` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_School_TravelTime_2` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Interpret_School_Other` longtext NOT NULL,
  ADD COLUMN `Con_Rate_Conference_PerHour` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Conference_Minimum` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Conference_Per_Mile` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Conference_Medium` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Conference_FullDay` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Conference_NoShow` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Conference_Cancelation` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Conference_TravelTime` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Conference_Other` longtext NOT NULL,
  ADD COLUMN `Con_Rate_VRI_PerMinute` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_VRI_PerHour` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_VRI_Minimum` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_VRI_NoShow` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_VRI_Cancelation` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_VRI_Other` longtext NOT NULL,
  ADD COLUMN `Con_Rate_Telephonic_PerMinute` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Telephonic_PerHour` VARCHAR(50) NOT NULL
  ADD COLUMN `Con_Rate_Telephonic_Minimum` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Telephonic_NoShow` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Telephonic_Cancelation` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Telephonic_Other` longtext NOT NULL,
  ADD COLUMN `Con_Rate_Translation_PerPage` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Translation_PerHour` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Translation_Repetition` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Translation_RushPerPage` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Translation_RushPerHour` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Translation_RushRepetition` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Translation_RushMinimum` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Transcription_PerWord` VARCHAR(50) NOT NULL
  ADD COLUMN `Con_Rate_Transcription_PerPage` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Transcription_PerHour` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Transcription_Rush` longtext NOT NULL,
  ADD COLUMN `Con_Rate_Transcription_RushPerWord` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Transcription_RushPerPage` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Transcription_RushPerHour` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Transcription_RushMinimum` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Transcription_RushOther` VARCHAR(50) NOT NULL,
  ADD COLUMN `Con_Rate_Other_Services` longtext NOT NULL,
  ADD COLUMN `Con_Rate_Depost` VARCHAR(500) NOT NULL,
  ADD COLUMN `Con_Referred_By_Name` VARCHAR(100) NOT NULL,
  ADD COLUMN `Con_Referred_By_Other` VARCHAR(100) NOT NULL;