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

public class EtudiantService {

    @WebMethod
    public boolean addEtudiant(@WebParam(name="nom")String nom,@WebParam(name="prenom")String prenom)
            throws SQLException {
        Connection con = Connexion.ConnectDB();
        String sql= "insert into users(nom,prenom) values(?,?)";
        PreparedStatement psmt = null;
        try {
            psmt = con.prepareStatement(sql);
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        psmt.setString(1, nom);
        psmt.setString(2, prenom);
        if (psmt.executeUpdate() !=0)
        {
            System.out.println("Insertion reussie");
        return true;
        }
        return false;
        //System.out.println("Insertion reussie");
    }

    @WebMethod
    public List<Etudiant> getEtudiants() throws SQLException {
        List<Etudiant> etudiants= new ArrayList<>();
        Connection con = Connexion.ConnectDB();
        String query= "select id,nom,prenom from users ";
        PreparedStatement pst = null;
        try {
            pst = con.prepareStatement(query);
            //pst.setInt(1,1);
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        ResultSet res= pst.executeQuery();
        while (res.next())
        {
            etudiants.add(new Etudiant(res.getInt("id"),res.getString("nom"),res.getString("prenom")));
        }
        return etudiants;
    }

    @WebMethod
    public boolean updateEtudiant(@WebParam(name="id")int id,@WebParam(name="nom")String nom,@WebParam(name="prenom")String prenom)
            throws SQLException {
        Connection con = Connexion.ConnectDB();
        String sql ="update users set nom=?,prenom=? where id=?";
        PreparedStatement psmt = null;
        try {
            psmt=con.prepareStatement(sql);
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        psmt.setString(1, nom);
        psmt.setString(2, prenom);
        psmt.setInt(3, id);
        if (psmt.executeUpdate() !=0){
            System.out.println("Modification effectuée");
            return true;
        }
        return false;

    }

    @WebMethod
    public boolean deleteEtudiant(@WebParam(name="id")int id)
            throws SQLException {
        Connection con = Connexion.ConnectDB();
        String sql="delete from users where id=?";
        PreparedStatement psmt = null;
        //Statement statement = con.createStatement();
        try {
            psmt=con.prepareStatement(sql);
        } catch (SQLException throwables) {
            throwables.printStackTrace();
        }
        psmt.setInt(1,id);
        if (psmt.executeUpdate() !=0){
            System.out.println("Suppression effectuée");
            return true;
        }
        return false;
    }






}
