package com.example.userevent;

import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.app.TimePickerDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;
import android.text.Editable;
import android.view.Gravity;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.TimePicker;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {
    private TextView textview;
    private EditText edittext;
    private Button button;
    private Button button1;
    private Button button2;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_event_2);

        textview = (TextView) findViewById(R.id.textview);
        edittext = (EditText) findViewById(R.id.edittext);
        button = (Button) findViewById(R.id.button);
        button1= (Button) findViewById(R.id.carendar);
        button2 = (Button) findViewById(R.id.btnclock);

        button.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v ){
                showTextView(v);
                //showToast();
                showDiallog();
            }
        });
        button1.setOnClickListener(new View.OnClickListener(){
            public void onClick(View v ) {
                showDialog();
            }
        });
        button2.setOnCLickListner(new View.onClickListener(){
           public void onClick (View v){
               showTimePicker();
           }
        });
    }
    public void showTextView(View view){
        Editable input = edittext.getText();
        textview.setText(input);

    }
    public void showTimePicker()
    {
        DatePickerDialog datePickerDialog = new DatePickerDialog(this,new TimePickerDialog.OnTimeSetListener() {
            public void onTimeSet(TimePicker view , int hourOfDay, int minute){}
        },1,51,true);
        datePickerDialog.setTitle("TimePickerDialog");
        datePickerDialog.setMessage("시간 선택 다이얼로그 입니다.");
        datePickerDialog.show();
    }
    public void showToast()
    {
        Editable input = edittext.getText();
        Context context = getApplicationContext();
        int duration = Toast.LENGTH_LONG;
        Toast toast = Toast.makeText(context,input,duration);
        toast.setGravity(Gravity.CENTER_VERTICAL,0,0);
        toast.show();
    }
    public void showDiallog(){
        Editable input = edittext.getText();
        AlertDialog.Builder builder = new AlertDialog.Builder(this);//객체생성
        builder.setMessage(input);
        builder.setTitle("대화상자 타이틀");
        builder.setPositiveButton("확인", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                showToast();
            }
        });
        builder.setNegativeButton("취소",null);
        AlertDialog dialog = builder.create();

        dialog.show();


    }
    public void showDialog(){
        ProgressDialog progressDialog = new ProgressDialog(this);
        progressDialog.setTitle("progressDialog");
        progressDialog.setMessage("진행 상황 다이얼로그");
        progressDialog.show();
        dateDialog();
    }
    public void dateDialog()
    {
        DatePickerDialog datepicker = new DatePickerDialog(this,new DatePickerDialog.OnDateSetListener(){
            public void onDateSet(DatePicker view , int year , int month, int dayonMonth){
                String msg= year+"년 "+month+"월 "+dayonMOnth+"일";

                this.showDialog(msg);
            }
        },2021,0,11);
        datepicker.setTitle("date picker Dialog");
        datepicker.show();
    }
}
