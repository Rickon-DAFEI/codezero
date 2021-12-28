import com.google.gson.*;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.util.HashMap;
import java.util.Map;

public class ReturnAnser extends HttpServlet{
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        Map<Integer,String> type_lis = new HashMap<Integer, String>();
        type_lis.put(1,"./");
        type_lis.put(2,"python3");
        type_lis.put(3,"java");
        response.setContentType("text/html;charset=utf-8");
        response.setHeader("Access-Control-Allow-Origin", "*");
        response.setHeader("Access-Control-Allow-Methods", "*");
        response.setHeader("Access-Control-Max-Age", "3600");
        response.setHeader("Access-Control-Allow-Headers", "*");
        response.setHeader("Access-Control-Allow-Credentials", "true");
        Gson gson = new Gson();
        String title = request.getParameter("title");
        String code_body = request.getParameter("code_body");
        String case_in= request.getParameter("case_in");
        int lan_index = Integer.parseInt(request.getParameter("lan_index"));
        Main_get Problem_case = new Main_get(lan_index,title,code_body,case_in);
        response.getWriter().println(lan_index+"\n"+title+"\n");
//        try {
//            Problem_case.create_file();
//        } catch (InterruptedException e) {
//            e.printStackTrace();
//        }
//        try {
//            Problem_case.get_anser_main();
//        } catch (InterruptedException e) {
//            e.printStackTrace();
//        }
//        response.getWriter().println(Problem_case.getCase_resoult());
    }
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        doGet(request,response);
    }
}
