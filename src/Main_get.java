import java.util.*;
import java.io.*;

public class Main_get {
    private int language_index;
    private String title;
    private String code_body;
    private String case_in;
    private String case_resoult;
    private int status;

    public String getCase_resoult() {
        return case_resoult;
    }

    public Main_get(int language_index, String title, String code_body, String case_in) {
        this.language_index = language_index;
        this.title = title;
        this.code_body = code_body;
        this.case_in = case_in;
    }
    public void printMessage(final InputStream input) {
        new Thread(new Runnable() {
            public void run() {
                Reader reader = new InputStreamReader(input);
                BufferedReader bf = new BufferedReader(reader);
                String line = null;
                try {
                    case_resoult="";
                    while((line=bf.readLine())!=null) {
                        case_resoult = case_resoult + line+"\n";
//                        System.out.println(line);
                    }
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        }).start();
    }
    public void create_file()throws IOException,InterruptedException{
        Map<Integer,String>type_lis = new HashMap<Integer, String>();
        type_lis.put(1,title+".cpp");
        type_lis.put(2,title+".python3");
        type_lis.put(3,"Main.java");
        int choice = this.language_index;
        String words = this.code_body;
        String line = this.case_in;
        String file_name = this.title+type_lis.get(choice);
//        new_file myfile_test = new new_file(this.title+type_lis.get(choice),words,choice);
//        myfile_test.create_file();
    }
    public int getLanguage_index() {
        return language_index;
    }

    public void get_anser_main() throws IOException,InterruptedException {

//        new_file myfiletest = new new_file(this.title+type_lis.get(choice),words,choice);
//        myfiletest.create_file();
//        if(choice==1){
//            String[] cmd = {"./",myfiletest.getTitle()};
//            try{
//                Runtime runtime = Runtime.getRuntime();
//                String oprator = "g++ -o " + myfiletest.getTitle()+ myfiletest.getFilename();
//                runtime.exec(oprator);
//                Process process = runtime.exec(cmd);
//                try{
////                    Runtime runtime = Runtime.getRuntime();
//                    process = runtime.exec(cmd);
//                    PrintStream outputWriter = new PrintStream(new BufferedOutputStream(process.getOutputStream()));
//                    String[] ss = line.split("\n");
//                    for(String x:ss ){
//                        outputWriter.println(x);
//                        outputWriter.flush();//这里一定要刷新缓冲区，不然参数传不过去
//                    }
//                    printMessage(process.getInputStream());
//                    printMessage(process.getErrorStream());
//                    int value = process.waitFor();
//                    this.status = value;
////            System.out.println(value);
//                }catch (Exception e){
//                    e.printStackTrace();
//                }
//                finally {
//                    if(process!=null){
//                        process.destroy();
//                        this.status = 1;
////                System.out.println("SUCCESS!");
//                    }
//                }
//
//            } catch (IOException e) {
//                e.printStackTrace();
//            }
//
//        }
//        else {
//            String[] cmd = {type_lis.get(choice), myfiletest.getFilename()};
//            Process process = null;
//            try{
//                Runtime runtime = Runtime.getRuntime();
//                process = runtime.exec(cmd);
//                PrintStream outputWriter = new PrintStream(new BufferedOutputStream(process.getOutputStream()));
//                String[] ss = line.split("\n");
//                for(String x:ss ){
//                    outputWriter.println(x);
//                    outputWriter.flush();//这里一定要刷新缓冲区，不然参数传不过去
//                }
//                printMessage(process.getInputStream());
//                printMessage(process.getErrorStream());
//                int value = process.waitFor();
//                this.status = value;
////            System.out.println(value);
//            }catch (Exception e){
//                e.printStackTrace();
//            }
//            finally {
//                if(process!=null){
//                    process.destroy();
//                    this.status = 1;
////                System.out.println("SUCCESS!");
//                }
//            }
//        }

    }

}