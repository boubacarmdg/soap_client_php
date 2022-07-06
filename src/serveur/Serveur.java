package serveur;
import javax.xml.ws.Endpoint;
import service.Service1;
public class Serveur {

    public static void main(String[] args) {
        // TODO Auto-generated method stub
        //System.setProperty("javax.xml.soap.SAAJMetaFactory", "com.sun.xml.messaging.saaj.soap.SAAJMetaFactoryImpl");
        String url="http://localhost:8585/";
        Endpoint.publish(url,new Service1());
        System.out.println(url);
    }

}
