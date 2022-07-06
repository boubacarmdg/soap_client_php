package service;

import metier.Connexion;
import metier.Etudiant;


import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.jws.WebService;
@WebService(name="BanqueWS")

public class Service1{
    @WebMethod
    public boolean deleteEtudiant(@WebParam(name="id")int id)
    {

        //Statement statement = con.createStatement();
        try {
            Connection con = Connexion.ConnectDB();
            String sql="delete from users where id=?";
            PreparedStatement psmt = null;
            psmt=con.prepareStatement(sql);
            psmt.setInt(1,id);
            if (psmt.executeUpdate() !=0){
                System.out.println("Suppression effectuée");
                return true;
            }
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        return false;
    }
    @WebMethod
    public boolean addEtudiant(@WebParam(name="nom")String nom,@WebParam(name="prenom")String prenom){
        try {
            Connection con = Connexion.ConnectDB();
            String sql= "insert into users(nom,prenom) values(?,?)";
            PreparedStatement psmt = null;
            psmt = con.prepareStatement(sql);
            psmt.setString(1, nom);
            psmt.setString(2, prenom);
            if (psmt.executeUpdate() !=0)
            {
                System.out.println("Insertion reussie");
                return true;
            }
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }

        return false;
        //System.out.println("Insertion reussie");
    }

    @WebMethod
    public List<Etudiant> getEtudiants()  {

        try {
            List<Etudiant> etudiants= new ArrayList<>();
            Connection con = Connexion.ConnectDB();
            String query= "select id,nom,prenom from users ";
            PreparedStatement pst = null;
            pst = con.prepareStatement(query);
            //pst.setInt(1,1);
            ResultSet res= pst.executeQuery();
            while (res.next())
            {
                etudiants.add(new Etudiant(res.getInt("id"),res.getString("nom"),res.getString("prenom")));
            }
            return etudiants;
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        return null;
    }

    @WebMethod
    public boolean updateEtudiant(@WebParam(name="id")int id,@WebParam(name="nom")String nom,@WebParam(name="prenom")String prenom)
            {

        try {
            Connection con = Connexion.ConnectDB();
            String sql ="update users set nom=?,prenom=? where id=?";
            PreparedStatement psmt = null;
            psmt=con.prepareStatement(sql);
            psmt.setString(1, nom);
            psmt.setString(2, prenom);
            psmt.setInt(3, id);
            if (psmt.executeUpdate() !=0){
                System.out.println("Modification effectuée");
                return true;
            }
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }

        return false;

    }





}
