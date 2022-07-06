package metier;
import java.sql.*;
public class Connexion {
    public static Connection ConnectDB ()
    {
        try{
            String urlPilote ="com.mysql.jdbc.Driver";
            Class.forName(urlPilote);
            System.out.println ("Le pilote a été bien chargé");
            String urlBD ="jdbc:mysql://localhost:3306/java1";
            String user  ="root";
            String  password="";
            Connection con =DriverManager.getConnection(urlBD, user, password);
            System.out.println ("Connexion bien établie");
            return con;
        } catch (Exception e)
        {
            e.printStackTrace();
            return  null;
        }
    }

}
